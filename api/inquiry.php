<?php
/**
 * AviNest Inquiry & Messaging REST API
 * Handles saving buyer inquiries and fetching breeder messages.
 */

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../config/db.php';

$db = Database::getConnection();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    if (!$input) $input = $_POST;

    if (empty($input['buyer_name']) || empty($input['buyer_email']) || empty($input['message'])) {
        echo json_encode(["success" => false, "message" => "Name, email, and message are required."]);
        exit;
    }

    $name = trim($input['buyer_name']);
    $email = filter_var(trim($input['buyer_email']), FILTER_VALIDATE_EMAIL);
    $message = trim($input['message']);
    $birdId = isset($input['bird_id']) ? (int)$input['bird_id'] : null;

    if (!$email) {
        echo json_encode(["success" => false, "message" => "Invalid email format."]);
        exit;
    }

    $stmt = $db->prepare("INSERT INTO inquiries (bird_id, buyer_name, buyer_email, message) VALUES (:bird_id, :name, :email, :msg)");
    $result = $stmt->execute([
        ':bird_id' => $birdId,
        ':name' => $name,
        ':email' => $email,
        ':msg' => $message
    ]);

    if ($result) {
        echo json_encode([
            "success" => true,
            "message" => "✉️ Inquiry sent successfully! Breeder will email you within 24 hours."
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to send inquiry."]);
    }
} else if ($method === 'GET') {
    $stmt = $db->query("SELECT i.id, i.buyer_name, i.buyer_email, i.message, i.date_sent, b.name AS bird_name 
                       FROM inquiries i 
                       LEFT JOIN birds b ON i.bird_id = b.id 
                       ORDER BY i.id DESC");
    $inquiries = $stmt->fetchAll();

    echo json_encode([
        "success" => true,
        "count" => count($inquiries),
        "data" => $inquiries
    ]);
}
