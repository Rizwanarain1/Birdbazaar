<?php
/**
 * AviNest Realtime Chat Messenger REST API
 * Handles saving and retrieving chat messages for Marketplace listings.
 */

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$method = $_SERVER['REQUEST_METHOD'];

if (!isset($_SESSION['avinest_chats'])) {
    $_SESSION['avinest_chats'] = [];
}

if ($method === 'GET') {
    $birdId = isset($_GET['bird_id']) ? $_GET['bird_id'] : 'default';
    $messages = isset($_SESSION['avinest_chats'][$birdId]) ? $_SESSION['avinest_chats'][$birdId] : [];
    echo json_encode(["success" => true, "data" => $messages]);
    exit;
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    if (!$input) $input = $_POST;

    $birdId = !empty($input['bird_id']) ? $input['bird_id'] : 'default';
    $sender = !empty($input['sender_name']) ? trim($input['sender_name']) : 'User';
    $email = !empty($input['sender_email']) ? trim($input['sender_email']) : 'user@avinest.com';
    $text = !empty($input['message']) ? trim($input['message']) : '';
    $image = !empty($input['image']) ? $input['image'] : null;
    $video = !empty($input['video']) ? $input['video'] : null;
    $audio = !empty($input['audio']) ? $input['audio'] : null;

    if (empty($text) && empty($image) && empty($video) && empty($audio)) {
        echo json_encode(["success" => false, "message" => "Message or media attachment is required."]);
        exit;
    }

    $msgObj = [
        "id" => !empty($input['id']) ? $input['id'] : uniqid("msg_"),
        "bird_id" => $birdId,
        "sender_name" => $sender,
        "sender_email" => $email,
        "message" => $text,
        "image" => $image,
        "video" => $video,
        "audio" => $audio,
        "timestamp" => date("h:i A")
    ];

    if (!isset($_SESSION['avinest_chats'][$birdId])) {
        $_SESSION['avinest_chats'][$birdId] = [];
    }

    $_SESSION['avinest_chats'][$birdId][] = $msgObj;

    echo json_encode([
        "success" => true,
        "message" => "Message sent!",
        "chat" => $_SESSION['avinest_chats'][$birdId]
    ]);
    exit;
}
