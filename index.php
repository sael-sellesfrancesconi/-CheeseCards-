<?php include("./utils/ini_session.php");?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Config / styles -->
    <?php include("./utils/common_head.php"); ?>
    <link rel="stylesheet" href="./public/styles_barre.css">
    <link rel="stylesheet" href="./public/styles_main.css">
</head>
<body data-aos="fade-in" class="cheese">
    
    <!-- Barre du haut -->
    <?php include("./parts/header_main.php"); ?>

    <!-- Pages (views / parts) -->
    <?php
    $p = $_GET['p'] ?? '';
    switch ($p) {
        case 'connect':
            include("./parts/view_connect.php");
            break;
        case 'new-account':
            include("./parts/view_new_account.php");
            break;
        case 'deconnect':
            include("./utils/user_deconnect.php");
            break;
        default:
            include("./parts/view_main.php");
            break;
    }?>
    <img data-aos="fade-left" src="./public/assets/cheese-bg-2.png">
    
    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script> AOS.init(); </script>
    
</body>