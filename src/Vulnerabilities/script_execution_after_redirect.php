<?php

if ($_SESSION['user_logged_in'] !== true) {
    header('Location: /login.php');
    //exit();
}

