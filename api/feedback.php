<?php
/**
 * BirdBazaar Feedback & Community Announcements REST API
 * Handles User Feedbacks, Star Ratings, Admin Announcements, and Announcement Comments.
 */

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/db.php';

$db = Database::getConnection();
$action = isset($_GET['action']) ? $_GET['action'] : '';

$input = json_decode(file_get_contents("php://input"), true);

switch ($action) {
    case 'list_feedbacks':
        listFeedbacks($db);
        break;
    case 'submit_feedback':
        submitFeedback($db, $input);
        break;
    case 'list_announcements':
        listAnnouncements($db);
        break;
    case 'create_announcement':
        createAnnouncement($db, $input);
        break;
    case 'submit_comment':
        submitComment($db, $input);
        break;
    case 'delete_feedback':
        deleteFeedback($db, $input);
        break;
    case 'delete_announcement':
        deleteAnnouncement($db, $input);
        break;
    default:
        echo json_encode(["success" => false, "message" => "Invalid feedback API action."]);
        break;
}

if (!function_exists('listFeedbacks')) {
    function listFeedbacks($db) {
        try {
            $stmt = $db->query("SELECT id, user_name, user_email, rating, category, comment, DATE_FORMAT(created_at, '%M %d, %Y') AS date_formatted FROM feedbacks WHERE status = 'approved' ORDER BY id DESC");
            $feedbacks = $stmt->fetchAll();

            $totalCount = count($feedbacks);
            $totalRating = 0;
            $counts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];

            foreach ($feedbacks as $f) {
                $r = (int)$f['rating'];
                $totalRating += $r;
                if (isset($counts[$r])) {
                    $counts[$r]++;
                }
            }

            $avgRating = $totalCount > 0 ? round($totalRating / $totalCount, 1) : 5.0;

            echo json_encode([
                "success" => true,
                "data" => $feedbacks,
                "summary" => [
                    "total" => $totalCount,
                    "average" => $avgRating,
                    "counts" => $counts
                ]
            ]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
}

if (!function_exists('submitFeedback')) {
    function submitFeedback($db, $data) {
        if (!$data || empty($data['comment']) || empty($data['rating'])) {
            echo json_encode(["success" => false, "message" => "Rating and comment are required."]);
            return;
        }

        $userName = !empty($data['user_name']) ? trim($data['user_name']) : 'Avian Lover';
        $userEmail = !empty($data['user_email']) ? trim($data['user_email']) : 'community@birdbazaar.com';
        $rating = max(1, min(5, (int)$data['rating']));
        $category = !empty($data['category']) ? trim($data['category']) : 'General Experience';
        $comment = trim($data['comment']);

        try {
            $stmt = $db->prepare("INSERT INTO feedbacks (user_name, user_email, rating, category, comment, status) VALUES (:name, :email, :rating, :cat, :comment, 'approved')");
            $result = $stmt->execute([
                ':name' => $userName,
                ':email' => $userEmail,
                ':rating' => $rating,
                ':cat' => $category,
                ':comment' => $comment
            ]);

            if ($result) {
                echo json_encode(["success" => true, "message" => "Thank you! Your feedback has been submitted."]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to submit feedback."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
}

if (!function_exists('listAnnouncements')) {
    function listAnnouncements($db) {
        try {
            $stmt = $db->query("SELECT id, admin_name, title, content, category, DATE_FORMAT(created_at, '%M %d, %Y - %h:%i %p') AS date_formatted FROM admin_announcements ORDER BY id DESC");
            $announcements = $stmt->fetchAll();

            foreach ($announcements as &$ann) {
                $cStmt = $db->prepare("SELECT id, user_name, user_email, comment_text, DATE_FORMAT(created_at, '%M %d, %Y - %h:%i %p') AS date_formatted FROM announcement_comments WHERE announcement_id = :aid ORDER BY id ASC");
                $cStmt->execute([':aid' => $ann['id']]);
                $ann['comments'] = $cStmt->fetchAll();
            }

            echo json_encode(["success" => true, "data" => $announcements]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
}

if (!function_exists('createAnnouncement')) {
    function createAnnouncement($db, $data) {
        if (!$data || empty($data['title']) || empty($data['content'])) {
            echo json_encode(["success" => false, "message" => "Title and content are required."]);
            return;
        }

        $adminName = !empty($data['admin_name']) ? trim($data['admin_name']) : 'AviNest Admin';
        $title = trim($data['title']);
        $content = trim($data['content']);
        $category = !empty($data['category']) ? trim($data['category']) : 'Official Update';

        try {
            $stmt = $db->prepare("INSERT INTO admin_announcements (admin_name, title, content, category) VALUES (:name, :title, :content, :cat)");
            $result = $stmt->execute([
                ':name' => $adminName,
                ':title' => $title,
                ':content' => $content,
                ':cat' => $category
            ]);

            if ($result) {
                echo json_encode(["success" => true, "message" => "Announcement post published successfully!", "id" => $db->lastInsertId()]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to publish announcement."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
}

if (!function_exists('submitComment')) {
    function submitComment($db, $data) {
        if (!$data || empty($data['announcement_id']) || empty($data['comment_text'])) {
            echo json_encode(["success" => false, "message" => "Announcement ID and comment text are required."]);
            return;
        }

        $announcementId = (int)$data['announcement_id'];
        $userName = !empty($data['user_name']) ? trim($data['user_name']) : 'Community Member';
        $userEmail = !empty($data['user_email']) ? trim($data['user_email']) : 'user@birdbazaar.com';
        $commentText = trim($data['comment_text']);

        try {
            $stmt = $db->prepare("INSERT INTO announcement_comments (announcement_id, user_name, user_email, comment_text) VALUES (:aid, :name, :email, :text)");
            $result = $stmt->execute([
                ':aid' => $announcementId,
                ':name' => $userName,
                ':email' => $userEmail,
                ':text' => $commentText
            ]);

            if ($result) {
                echo json_encode(["success" => true, "message" => "Your reply has been posted!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to post comment."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
}

if (!function_exists('deleteFeedback')) {
    function deleteFeedback($db, $data) {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($data['id']) ? (int)$data['id'] : 0);
        if ($id <= 0) {
            echo json_encode(["success" => false, "message" => "Invalid ID."]);
            return;
        }

        $stmt = $db->prepare("DELETE FROM feedbacks WHERE id = :id");
        $result = $stmt->execute([':id' => $id]);

        echo json_encode(["success" => (bool)$result]);
    }
}

if (!function_exists('deleteAnnouncement')) {
    function deleteAnnouncement($db, $data) {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($data['id']) ? (int)$data['id'] : 0);
        if ($id <= 0) {
            echo json_encode(["success" => false, "message" => "Invalid ID."]);
            return;
        }

        $stmt = $db->prepare("DELETE FROM admin_announcements WHERE id = :id");
        $result = $stmt->execute([':id' => $id]);

        echo json_encode(["success" => (bool)$result]);
    }
}
