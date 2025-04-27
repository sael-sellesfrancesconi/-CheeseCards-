<?php include("./utils/ini_session.php");?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Elements -->
    <?php include("./src/config/head.php"); ?>

    <!-- Styles du site -->
    <link rel="stylesheet" href="./public/couleurs.css">
    <link rel="stylesheet" href="./public/styles_main.css">

    <!-- Styles externes -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    #switch-arrow {
        position: fixed;
        top: 50vh;
        right: 0;
        transform: translateY(-50%);
        background: #333;
        color: white;
        padding: 10px;
        cursor: pointer;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        font-size: 24px;
        z-index: 9999;
        user-select: none;
        transition: background 0.3s;
    }
    #switch-arrow:hover {
        background: #555;
    }
    </style>
</head>
<body data-aos="fade-in" class="cheeses">
    
    <!-- Barre du haut -->
    <?php include("./parts/common_header.php"); ?>

    <!-- Pages (views) -->
    <?php
    if (isset($_GET['p']) && $_GET['p'] === 'connect')
    {
        include("./parts/view_connect.php");
    } 
    else if (isset($_GET['p']) && $_GET['p'] === 'new-account')
    {
        include("./parts/view_new_account.php");
    } 
    else if (isset($_GET['p']) && $_GET['p'] === 'home')
    {
        include("./parts/view_home.php");
    }
    else if (isset($_GET['p']) && $_GET['p'] === 'collection')
    {
        include("./parts/view_collection.php");
    }
    else if (isset($_GET['p']) && $_GET['p'] === 'collection')
    {
        include("./parts/view_new_card.php");
    } 
    else // Par défaut :
    {
        include("./parts/view_main.php");
    }
    ?>
    <div id="switch-arrow" onclick="theme_select();">➤</div>

    <!-- Scripts -->
    <script src="./public/script_seasons.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script> AOS.init(); </script>
</body>
<!-- 𝗢𝘄𝗢
⟦ 𝗟𝗼𝘁𝗳𝗶 𝗲𝘀𝘁 𝘀𝗲𝘅𝘆 ! ⟧
𝗨𝘄𝗨 -->