<?php
/**
 * AviNest Birds & Marketplace REST API
 * Handles Fetching, Filtering, Adding, and Deleting bird species and marketplace listings.
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
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        fetchBirds($db);
        break;
    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        if ($input && isset($input['action']) && $input['action'] === 'mark_sold') {
            markSold($db, $input);
        } else {
            createBird($db);
        }
        break;
    case 'DELETE':
        deleteBird($db);
        break;
    default:
        echo json_encode(["success" => false, "message" => "Method not supported."]);
        break;
}

function markSold($db, $input) {
    $birdId = isset($input['bird_id']) ? (int)$input['bird_id'] : 0;
    if ($birdId <= 0) {
        echo json_encode(["success" => false, "message" => "Invalid bird ID."]);
        return;
    }
    $stmt = $db->prepare("UPDATE birds SET status = 'sold' WHERE id = :id");
    $result = $stmt->execute([':id' => $birdId]);
    echo json_encode(["success" => $result, "message" => $result ? "Marked as SOLD!" : "Failed to update status."]);
}

/**
 * Fetch birds with dynamic filtering and SQL query building
 */
function fetchBirds($db) {
    $where = ["1=1"];
    $params = [];

    // Category filter
    if (!empty($_GET['cat']) && $_GET['cat'] !== 'all') {
        $where[] = "c.slug = :cat";
        $params[':cat'] = $_GET['cat'];
    }

    // User-only filter (Marketplace: only show posts created by registered users, excluding seed dataset 101-108)
    if (!empty($_GET['user_only']) && $_GET['user_only'] == '1') {
        $where[] = "b.user_id IS NOT NULL AND b.id NOT IN (101, 102, 103, 104, 105, 106, 107, 108)";
    }

    // Noise level filter
    if (!empty($_GET['volume']) && $_GET['volume'] !== 'Any') {
        $where[] = "b.volume = :volume";
        $params[':volume'] = $_GET['volume'];
    }

    // Intelligence filter
    if (!empty($_GET['intel'])) {
        $where[] = "b.intel_level = :intel";
        $params[':intel'] = $_GET['intel'];
    }

    // Max Price filter
    if (!empty($_GET['max_price']) && is_numeric($_GET['max_price'])) {
        $where[] = "b.price <= :max_price";
        $params[':max_price'] = (float)$_GET['max_price'];
    }

    // Beginner friendly filter
    if (isset($_GET['beginner']) && $_GET['beginner'] !== 'all') {
        $where[] = "b.friendly = :friendly";
        $params[':friendly'] = $_GET['beginner'] === 'yes' ? 1 : 0;
    }

    // Search query filter
    if (!empty($_GET['q'])) {
        $search = '%' . trim($_GET['q']) . '%';
        $where[] = "(b.name LIKE :q1 OR b.sci_name LIKE :q2 OR b.origin LIKE :q3)";
        $params[':q1'] = $search;
        $params[':q2'] = $search;
        $params[':q3'] = $search;
    }

    $whereSql = implode(" AND ", $where);

    $sql = "SELECT b.id, b.name, b.sci_name AS sci, b.origin, b.lifespan AS life, b.price, 
                   b.volume, b.friendly, b.intel_level AS intel, b.status, b.verified, 
                   b.image_url AS image, b.images_json AS images_raw, b.video_url AS video, b.description, b.date_listed AS date,
                   c.slug AS category, c.name_en AS category_name, u.name AS breeder
            FROM birds b
            JOIN categories c ON b.category_id = c.id
            LEFT JOIN users u ON b.user_id = u.id
            WHERE $whereSql
            ORDER BY b.id DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $birds = $stmt->fetchAll();

    // Process boolean types, price floats, images array & video URLs
    foreach ($birds as &$bird) {
        $bird['friendly'] = (bool)$bird['friendly'];
        $bird['verified'] = (bool)$bird['verified'];
        $bird['price'] = (float)$bird['price'];

        if (!empty($bird['images_raw'])) {
            $decodedImages = json_decode($bird['images_raw'], true);
            if (is_array($decodedImages) && count($decodedImages) > 0) {
                $bird['images'] = $decodedImages;
            } else {
                $bird['images'] = [$bird['image']];
            }
        } else {
            $bird['images'] = [$bird['image']];
        }
        unset($bird['images_raw']);
    }

    echo json_encode([
        "success" => true,
        "count" => count($birds),
        "data" => $birds
    ]);
}

/**
 * Create a new bird listing
 */
function createBird($db) {
    $input = json_decode(file_get_contents("php://input"), true);
    if (!$input) {
        $input = $_POST;
    }

    if (empty($input['name']) || empty($input['price']) || empty($input['category'])) {
        echo json_encode(["success" => false, "message" => "Bird name, price, and category are required."]);
        return;
    }

    $name = trim($input['name']);
    $sci = !empty($input['sci']) ? trim($input['sci']) : 'Psittaciformes';
    $origin = !empty($input['origin']) ? trim($input['origin']) : 'Tropical Region';
    $life = !empty($input['life']) ? trim($input['life']) : '15-20 Years';
    $price = (float)$input['price'];
    $volume = !empty($input['volume']) ? trim($input['volume']) : 'Quiet';
    $friendly = isset($input['friendly']) && ($input['friendly'] === true || $input['friendly'] === 'yes' || $input['friendly'] === 1) ? 1 : 0;
    $intel = !empty($input['intel']) ? trim($input['intel']) : 'Active Learner';
    $categorySlug = trim($input['category']);
    $image = !empty($input['image']) ? trim($input['image']) : 'images/african_grey.png';

    // Parse multi-images & video clip
    $imagesJson = null;
    if (!empty($input['images']) && is_array($input['images'])) {
        $imagesJson = json_encode($input['images']);
    } else if (!empty($image)) {
        $imagesJson = json_encode([$image]);
    }
    $videoUrl = !empty($input['video']) ? trim($input['video']) : null;
    $description = !empty($input['description']) ? trim($input['description']) : "Beautiful $name available on AviNest Marketplace.";

    // Find category ID
    $catStmt = $db->prepare("SELECT id FROM categories WHERE slug = :slug OR name_en = :name LIMIT 1");
    $catStmt->execute([':slug' => strtolower($categorySlug), ':name' => $categorySlug]);
    $catRow = $catStmt->fetch();

    $categoryId = $catRow ? $catRow['id'] : 1; // Fallback to Parrots (1)
    $userId = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : (!empty($input['user_id']) ? (int)$input['user_id'] : 999);

    $sql = "INSERT INTO birds (category_id, user_id, name, sci_name, origin, lifespan, price, volume, friendly, intel_level, status, verified, image_url, images_json, video_url, description, date_listed)
            VALUES (:cat_id, :user_id, :name, :sci, :origin, :life, :price, :volume, :friendly, :intel, 'available', 0, :image, :images_json, :video_url, :desc, CURRENT_DATE)";

    $stmt = $db->prepare($sql);
    $result = $stmt->execute([
        ':cat_id' => $categoryId,
        ':user_id' => $userId,
        ':name' => $name,
        ':sci' => $sci,
        ':origin' => $origin,
        ':life' => $life,
        ':price' => $price,
        ':volume' => $volume,
        ':friendly' => $friendly,
        ':intel' => $intel,
        ':image' => $image,
        ':images_json' => $imagesJson,
        ':video_url' => $videoUrl,
        ':desc' => $description
    ]);

    if ($result) {
        echo json_encode([
            "success" => true,
            "message" => "🎉 Bird listing created successfully!",
            "id" => $db->lastInsertId()
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to create listing."]);
    }
}

/**
 * Delete a bird listing
 */
function deleteBird($db) {
    $birdId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($birdId <= 0) {
        echo json_encode(["success" => false, "message" => "Invalid bird ID."]);
        return;
    }

    $stmt = $db->prepare("DELETE FROM birds WHERE id = :id");
    $result = $stmt->execute([':id' => $birdId]);

    if ($result) {
        echo json_encode(["success" => true, "message" => "Listing deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete listing."]);
    }
}
