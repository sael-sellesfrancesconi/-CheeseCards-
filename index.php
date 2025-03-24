<?php
    session_start();
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;

    $user = false;

    if ($_GET['p'] == 'deconnect') {
        $user = false;
    }

    if ($_GET['p'] == 'connect') {
        $user = true;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php //include(""); ?>
    
    <title> CheeseCards - Accueil </title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="fromage">
<header>
    <a href="?p">
        <h1><b class="special">Cheese</b>Cards <b class="special">!</b></h1>
    </a>
    <section id="liens_centre">
        <a href="?p=codex"><h2>Codex</h2></a>
        <?php if ($user === true): ?>
            <a href="?p=buy"><h2>Acheter des fromages</h2></a>
            <a href="?p=deconnect"><h2>Se déconnecter</h2></a>
        <?php else: ?>
            <a href="?p=new-account"><h2>Créer un compte</h2></a>
        <?php endif; ?>
    </section>
    <section>
        <a id="bouton" href="?p=<?= $user === true ? 'account' : 'connect' ?>">
            <?= $user === true ? 'Mon compte' : 'Se connecter' ?>
        </a>
    </section>
</header>
<main>
    <div id="text">
        <h1>Vous aimez le <b class="special">fromage</b> ?</h1>
        <p>
            <b class="special">Collectionnez</b> les cartes de nombreux fromages, ayant chacun une identité unique.
            <b class="special">Découvrez</b> de nouveaux goûts et de nouveaux caractères du terroir.
        </p>
    </div>
</main>
</body>
</html>