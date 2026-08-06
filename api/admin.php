<?php
/**
 * AviNest Admin Dashboard REST API
 * Handles User Management (Toggle Active/Unactive status, Delete Users) and Analytics Stats.
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
    case 'users':
        getUsers($db);
        break;
    case 'toggle_status':
        toggleUserStatus($db, $input);
        break;
    case 'change_role':
        changeUserRole($db, $input);
        break;
    case 'user_activity':
        getUserActivity($db);
        break;
    case 'delete_user':
        deleteUser($db, $input);
        break;
    case 'stats':
        getDashboardStats($db);
        break;
    default:
        echo json_encode(["success" => false, "message" => "Invalid admin action."]);
        break;
}

/**
 * Get all users list
 */
function getUsers($db) {
    $stmt = $db->query("SELECT id, name, email, password_hash, role, status, avatar, DATE_FORMAT(created_at, '%Y-%m-%d') AS joined_date FROM users ORDER BY id DESC");
    $users = $stmt->fetchAll();

    echo json_encode([
        "success" => true,
        "count" => count($users),
        "data" => $users
    ]);
}

/**
 * Toggle user active/unactive status
 */
function toggleUserStatus($db, $data) {
    if (!$data || empty($data['user_id'])) {
        echo json_encode(["success" => false, "message" => "User ID is required."]);
        return;
    }

    $userId = (int)$data['user_id'];
    $newStatus = isset($data['status']) && in_array($data['status'], ['active', 'unactive']) ? $data['status'] : null;

    if (!$newStatus) {
        // Fetch current status and toggle
        $stmt = $db->prepare("SELECT status FROM users WHERE id = :id");
        $stmt->execute([':id' => $userId]);
        $row = $stmt->fetch();
        if (!$row) {
            echo json_encode(["success" => false, "message" => "User not found."]);
            return;
        }
        $newStatus = ($row['status'] === 'active') ? 'unactive' : 'active';
    }

    $updateStmt = $db->prepare("UPDATE users SET status = :status WHERE id = :id");
    $result = $updateStmt->execute([':status' => $newStatus, ':id' => $userId]);

    if ($result) {
        echo json_encode([
            "success" => true,
            "message" => "User status updated to '$newStatus'!",
            "user_id" => $userId,
            "status" => $newStatus
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update user status."]);
    }
}

/**
 * Delete user account
 */
function deleteUser($db, $data) {
    $userId = 0;
    if (isset($_GET['id'])) {
        $userId = (int)$_GET['id'];
    } else if ($data && !empty($data['user_id'])) {
        $userId = (int)$data['user_id'];
    }

    if ($userId <= 0) {
        echo json_encode(["success" => false, "message" => "Invalid user ID."]);
        return;
    }

    // Prevent deleting primary admin
    if ($userId === 1) {
        echo json_encode(["success" => false, "message" => "Primary system admin cannot be deleted."]);
        return;
    }

    // 1. Fetch user email to record in deleted_users
    $uStmt = $db->prepare("SELECT email FROM users WHERE id = :id");
    $uStmt->execute([':id' => $userId]);
    $uRow = $uStmt->fetch();

    if ($uRow) {
        $insDel = $db->prepare("INSERT INTO deleted_users (email) VALUES (:email) ON DUPLICATE KEY UPDATE email=email");
        $insDel->execute([':email' => strtolower($uRow['email'])]);
    }

    // 2. Cascade delete all bird listings posted by this user
    $delBirds = $db->prepare("DELETE FROM birds WHERE user_id = :user_id");
    $delBirds->execute([':user_id' => $userId]);

    // 3. Delete user account
    $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
    $result = $stmt->execute([':id' => $userId]);

    if ($result) {
        echo json_encode(["success" => true, "message" => "User account deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete user account."]);
    }
}

/**
 * Get aggregated dashboard statistics
 */
function getDashboardStats($db) {
    $totalUsers = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $activeUsers = $db->query("SELECT COUNT(*) FROM users WHERE status = 'active'")->fetchColumn();
    $totalBirds = $db->query("SELECT COUNT(*) FROM birds")->fetchColumn();
    $pendingVerification = $db->query("SELECT COUNT(*) FROM birds WHERE verified = 0")->fetchColumn();

    echo json_encode([
        "success" => true,
        "stats" => [
            "total_users" => (int)$totalUsers,
            "active_users" => (int)$activeUsers,
            "total_birds" => (int)$totalBirds,
            "pending_verifications" => (int)$pendingVerification
        ]
    ]);
}

/**
 * Change user role (admin, breeder, user)
 */
function changeUserRole($db, $data) {
    if (!$data || empty($data['user_id']) || empty($data['role'])) {
        echo json_encode(["success" => false, "message" => "User ID and Role are required."]);
        return;
    }

    $userId = (int)$data['user_id'];
    $role = in_array($data['role'], ['admin', 'breeder', 'user']) ? $data['role'] : 'user';

    $stmt = $db->prepare("UPDATE users SET role = :role WHERE id = :id");
    $result = $stmt->execute([':role' => $role, ':id' => $userId]);

    if ($result) {
        echo json_encode(["success" => true, "message" => "User role updated to '$role'!", "role" => $role]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update user role."]);
    }
}

/**
 * Get comprehensive activity data for a specific user
 */
function getUserActivity($db) {
    $userId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($userId <= 0) {
        echo json_encode(["success" => false, "message" => "Valid user ID is required."]);
        return;
    }

    $userStmt = $db->prepare("SELECT id, name, email, password_hash, role, status, created_at FROM users WHERE id = :id");
    $userStmt->execute([':id' => $userId]);
    $user = $userStmt->fetch();

    if (!$user) {
        echo json_encode(["success" => false, "message" => "User not found."]);
        return;
    }

    $birdsStmt = $db->prepare("SELECT id, name, price, status, date_listed FROM birds WHERE user_id = :id");
    $birdsStmt->execute([':id' => $userId]);
    $listings = $birdsStmt->fetchAll();

    $inqStmt = $db->prepare("SELECT id, buyer_name, buyer_email, message, date_sent FROM inquiries WHERE buyer_email = :email");
    $inqStmt->execute([':email' => $user['email']]);
    $inquiries = $inqStmt->fetchAll();

    echo json_encode([
        "success" => true,
        "user" => $user,
        "listings" => $listings,
        "inquiries" => $inquiries
    ]);
}
