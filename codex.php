<?php include("./utils/ini_session.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Config / styles -->
    <title> CheeseCards - Codex </title>
    <link rel="stylesheet" href="./public/styles_header.css">
    <link rel="stylesheet" href="./public/styles_common_pages.css">
    <?php include("./utils/common_head.php"); ?>
</head>
<body data-aos="fade-in" class="cheese">
    
    <!-- Header -->
    <?php include("./parts/header_codex.php");?>
    
    <!-- Contenu -->
	<section class="container">
        <div class="content" id="content">
            <?php include("./utils/show_cheeses_codex.php");?>
        </div>
    </section>
    
    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script> AOS.init(); </script>
    
</body>
</html>
