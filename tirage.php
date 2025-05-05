<?php
include("./utils/ini_session.php");
include("./utils/db_access.php");
include("./utils/user_tirage.php");

$dropRates = [ 
    'commun' => 60.0, 
    'peu commun' => 25.0, 
    'rare' => 10.0, 
    'épique' => 3.0, 
    'légendaire' => 1.0, 
    'or' => 0.5, 
    'diamant' => 0.499, 
    'FOAT' => 0.001 
];

function getDropRate($category) {
    global $dropRates;
    return isset($dropRates[$category]) ? $dropRates[$category] : 0.0;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    
    <!-- Styles / config -->
    <title>Tirage de cartes</title>
    <link rel="stylesheet" href="./public/couleurs.css">
    <link rel="stylesheet" href="./public/styles_header.css">
    <link rel="stylesheet" href="./public/styles_common_pages.css">
    <?php include("./utils/common_head.php"); ?>
</head>
<body class="cheese">
    
    <!-- Header -->
    <?php include("./parts/header_tirage.php"); ?>
    
    <section class="container-tirage">
        <div>
            <nav class="content">
                <h1>Tirage de cartes</h1>
                <?php if ($can_draw): ?>
                    <p>Voici tes cartes ! Elles vont être ajoutées à ta collection. </p>
                <?php else: ?>
                    <p>Tu as déjà tiré tes cartes. Reviens dans une heure !</p>
                <?php endif; ?>
            </nav>
        </div>
        <?php if ($can_draw): ?>
        <section class="content-home">
            <?php foreach ($cards as $card): 
            $stmt = $pdo->prepare("
                SELECT f.nom AS fromage, f.description, f.image_url, c.nom AS categorie
                FROM cheeses f
                LEFT JOIN categories c ON f.categorie_id = c.id
                WHERE f.id = ?
            ");
            $stmt->execute([$card['id']]);
            $fromage = $stmt->fetch();
            
            $dropRate = getDropRate($fromage['categorie']);
            ?>
            <div class="card-home tirage" data-drop-rate="<?= $dropRate ?>">
                <h2><?= htmlspecialchars($fromage['fromage']) ?></h2>
                <p><?= nl2br(htmlspecialchars($fromage['description'])) ?></p>
                <?php if ($fromage['image_url']): ?>
                    <img src="<?= $fromage['image_url'] ?>" alt="">
                <?php endif; ?>
                <h4><?= htmlspecialchars($fromage['categorie']) ?></h4>
                <p><strong>Taux de drop: </strong><?= $dropRate ?>%</p>
            </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>
    </section>
    
    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>
</html>
