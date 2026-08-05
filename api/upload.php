<?php
/**
 * AviNest Real Image Upload REST API
 * Validates, sanitizes, and uploads bird images to the uploads/ directory.
 */

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$uploadDir = __DIR__ . '/../uploads/';

// Ensure uploads directory exists
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Only POST method is allowed."]);
    exit;
}

$uploadedImages = [];
$uploadedVideo = null;
$uploadedAudio = null;

// Helper to save single file
function saveUploadFile($fileArr, $uploadDir, $isVideo = false, $isAudio = false) {
    if (!$fileArr || $fileArr['error'] !== UPLOAD_ERR_OK) return null;
    $tmpName = $fileArr['tmp_name'];
    $ext = strtolower(pathinfo($fileArr['name'], PATHINFO_EXTENSION));
    
    $allowedImg = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $allowedVid = ['mp4', 'webm', 'mov', 'avi', 'm4v', '3gp', 'mkv'];
    $allowedAud = ['mp3', 'wav', 'ogg', 'webm', 'm4a', 'aac', 'mp4'];

    if ($isVideo && !in_array($ext, $allowedVid)) return null;
    if ($isAudio && !in_array($ext, $allowedAud)) return null;
    if (!$isVideo && !$isAudio && !in_array($ext, $allowedImg)) return null;

    $prefix = $isVideo ? 'video_' : ($isAudio ? 'audio_' : 'bird_');
    $newName = $prefix . time() . '_' . rand(1000, 9999) . '.' . $ext;
    $dest = $uploadDir . $newName;

    if (move_uploaded_file($tmpName, $dest)) {
        return 'uploads/' . $newName;
    }
    return null;
}

// 1. Handle Multiple Images
if (isset($_FILES['images'])) {
    $files = $_FILES['images'];
    if (is_array($files['name'])) {
        $count = min(count($files['name']), 3); // Max 3 images
        for ($i = 0; $i < $count; $i++) {
            $singleFile = [
                'name' => $files['name'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            ];
            $saved = saveUploadFile($singleFile, $uploadDir, false, false);
            if ($saved) $uploadedImages[] = $saved;
        }
    }
} elseif (isset($_FILES['image'])) {
    $saved = saveUploadFile($_FILES['image'], $uploadDir, false, false);
    if ($saved) $uploadedImages[] = $saved;
}

// 2. Handle Video File
if (isset($_FILES['video'])) {
    $savedVid = saveUploadFile($_FILES['video'], $uploadDir, true, false);
    if ($savedVid) $uploadedVideo = $savedVid;
}

// 3. Handle Audio File
if (isset($_FILES['audio'])) {
    $savedAud = saveUploadFile($_FILES['audio'], $uploadDir, false, true);
    if ($savedAud) $uploadedAudio = $savedAud;
}

$mainImage = !empty($uploadedImages) ? $uploadedImages[0] : null;

echo json_encode([
    "success" => true,
    "message" => "Media uploaded successfully!",
    "image_url" => $mainImage,
    "image_urls" => $uploadedImages,
    "video_url" => $uploadedVideo,
    "audio_url" => $uploadedAudio
]);
