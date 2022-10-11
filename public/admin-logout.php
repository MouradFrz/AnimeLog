<?php

session_start();
unset($_SESSION['loggedinadmin']);
header('Location: index.php');