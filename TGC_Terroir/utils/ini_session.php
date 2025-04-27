<?php
    session_start();
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;

    if (isset($_SESSION['user'])) 
    {
        $user = $_SESSION['user'];
    }
?>