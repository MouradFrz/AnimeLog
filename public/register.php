<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

use src\Utilities\SessionStatus;
use src\Utilities\Database;
use src\Models\User;
use src\Controllers\UserController;

SessionStatus::RedirectIfLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $user = new User($_POST['email'], $_POST['password'], $_POST['password_confirm']);
    if (!UserController::completeFields($user)) {
        $error = "All fields are required.";
    } elseif (!UserController::validateEmailFormat($user)) {
        $error = "Invalide e-mail address.";
    } elseif (!UserController::validatePassword($user)) {
        $error = "The password must contain at least one uppercase letter, lowercase letter and a number. <br>The password must be at least 6 characters long.";
    } elseif (!UserController::validateConfirm($user)) {
        $error = "Password and confirmation don't match.";
    } elseif (!UserController::validateTakenEmail($user)) {
        $error = "Email is already taken.";
    } else {
        UserController::createNewUser($user);
        $_SESSION['register_success'] = 'success';
        header('Location: login.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body class="bg-light">
    <div class="wrapper">
        <?php if (isset($error)) {
            echo '<p>' . $error . '</p>';
        } ?>
        <form method="POST" action="">
            <h1 class="text-center">Register</h1>
            <div class="form-outline mb-4">
                <label class="form-label">Email address</label>
                <input type="text" name="email" class="form-control" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirm" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
            <div class="text-center">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>