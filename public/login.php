<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

use src\Utilities\SessionStatus;
use src\Controllers\UserController;

SessionStatus::RedirectIfLoggedIn('user');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = UserController::attemptLogin($email, $password);
    if ($result) {
        header('Location: index.php');
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
        <?php
        if (isset($_SESSION['register_success'])) {
            echo '<p>Registered Successfully</p>';
            unset($_SESSION['register_success']);
        }
        if (isset($result) && !$result) {
            echo '<p>Invalide credentials.</p>';
        }
        ?>
        <form method="POST" action="">
            <h1 class="text-center">Login</h1>
            <div class="form-outline mb-4">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
            <div class="text-center">
                <p>Not a member? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>