<?php
include("./utils/db_access.php");

// On récupère d'abord les fromages rares et très haut niveau
$idsExclus = [];

// Fromages rares
$categorieId = 2;
$stmt = $pdo->prepare("SELECT id FROM cheeses WHERE categorie_id = :categorieId");
$stmt->execute(['categorieId' => $categorieId]);
$idsExclus = array_merge($idsExclus, array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id'));

// Très haut niveau : Fromage ID 1 et 42
$idsExclus[] = 1;
$idsExclus[] = 42;

// Préparer SQL pour exclure les IDs
$placeholders = implode(',', array_fill(0, count($idsExclus), '?'));
$exclusionSQL = $placeholders ? "WHERE f.id NOT IN ($placeholders)" : "";

// Fonction pour afficher une section
function afficher_fromages($pdo, $titre, $prix, $exclusionSQL = "", $params = []) {
    echo "<h2> $titre </h2><section>";

    $sql = "
        SELECT 
            f.id,
            f.nom AS fromage,
            c.nom AS categorie,
            f.description,
            f.image_url
        FROM cheeses f
        LEFT JOIN categories c ON f.categorie_id = c.id
        $exclusionSQL
        ORDER BY RAND()
        LIMIT 8
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $fromages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($fromages as $fromage) {
        echo "<div class='card'>";
        echo "<div class='card-inner'>";
        echo "<div class='infos'>";
        echo "<h3>{$fromage['fromage']}</h3>";
        echo "<h4>{$fromage['categorie']}</h4>";
        echo "</div>";
        echo "<p>" . nl2br(htmlspecialchars($fromage['description'])) . "</p>";
        if (!empty($fromage['image_url'])) {
            echo "<img src='{$fromage['image_url']}' alt='Image de {$fromage['fromage']}'>";
        }
        echo "<div class='achat'>";
        if (isset($_SESSION["user"])){
            echo "<h4><a class='acheter-btn' data-id='{$fromage['id']}' data-prix='" . str_replace('€', '', $prix) . "'> Acheter </a></h4>";
        }
        echo "<h4> $prix </h4>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    echo "</section>";
}

// Afficher "La sélection du jour"
afficher_fromages($pdo, "La sélection du jour", "1.99€", $exclusionSQL, $idsExclus);

// Afficher "Les plus populaires"
afficher_fromages($pdo, "Les plus populaires", "2.99€", $exclusionSQL, $idsExclus);

// Fromages rares
echo "<h2> Les plus rares </h2><section>";
$stmt = $pdo->prepare("
    SELECT 
        f.id,
        f.nom AS fromage,
        c.nom AS categorie,
        f.description,
        f.image_url
    FROM cheeses f
    LEFT JOIN categories c ON f.categorie_id = c.id
    WHERE f.categorie_id = :categorieId
    ORDER BY f.id ASC
    LIMIT 8
");
$stmt->execute(['categorieId' => $categorieId]);
$fromages = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($fromages as $fromage) {
    echo "<div class='card'>";
    echo "<div class='card-inner'>";
    echo "<div class='infos'>";
    echo "<h3>{$fromage['fromage']}</h3>";
    echo "<h4>{$fromage['categorie']}</h4>";
    echo "</div>";
    echo "<p>" . nl2br(htmlspecialchars($fromage['description'])) . "</p>";
    if (!empty($fromage['image_url'])) {
        echo "<img src='{$fromage['image_url']}' alt='Image de {$fromage['fromage']}'>";
    }
    echo "<div class='achat'>";
    if (isset($_SESSION["user"])){
        echo "<h4><a class='acheter-btn' data-id='{$fromage['id']}' data-prix='5.99'> Acheter </a></h4>";
    }
    echo "<h4> 5.99€ </h4>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
echo "</section>";

// Très haut niveau (ID 1 et 42)
echo "<h2> Les très haut niveaux </h2><section>";
foreach ([1, 42] as $fromageId) {
    $stmt = $pdo->prepare("
        SELECT 
            f.id,
            f.nom AS fromage,
            c.nom AS categorie,
            f.description,
            f.image_url
        FROM cheeses f
        LEFT JOIN categories c ON f.categorie_id = c.id
        WHERE f.id = :fromageId
    ");
    $stmt->execute(['fromageId' => $fromageId]);
    $fromage = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($fromage) {
        echo "<div class='card'>";
        echo "<div class='card-inner'>";
        echo "<div class='infos'>";
        echo "<h3>{$fromage['fromage']}</h3>";
        echo "<h4>{$fromage['categorie']}</h4>";
        echo "</div>";
        echo "<p>" . nl2br(htmlspecialchars($fromage['description'])) . "</p>";
        if (!empty($fromage['image_url'])) {
            echo "<img src='{$fromage['image_url']}' alt='Image de {$fromage['fromage']}'>";
        }
        echo "<div class='achat'>";
        if (isset($_SESSION["user"])){
            echo "<h4><a class='acheter-btn' data-id='{$fromage['id']}' data-prix='5.99'> Acheter </a></h4>";
        }
        echo "<h4> 5.99€ </h4>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}
echo "</section>";
?>