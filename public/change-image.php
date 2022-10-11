<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

use src\Utilities\SessionStatus;
use src\Controllers\UserController;
SessionStatus::RedirectIfNotLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $image_parts = explode(";base64,", $_POST['image']);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $file = 'assets/profile-images/'. $_SESSION['loggedin'] .'.'. $image_type;
    file_put_contents($file, $image_base64);
    echo json_encode(["image uploaded successfully."]);
}
