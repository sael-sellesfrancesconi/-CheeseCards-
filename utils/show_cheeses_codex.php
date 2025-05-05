<?php
include("./utils/db_access.php");

$search = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($search !== '') {
    $stmt = $pdo->prepare("
        SELECT f.id, f.nom AS fromage, c.nom AS categorie, f.description, f.image_url
        FROM cheeses f
        LEFT JOIN categories c ON f.categorie_id = c.id
        WHERE f.nom LIKE :search OR c.nom LIKE :search
        ORDER BY f.id ASC
    ");
    $stmt->execute(['search' => '%' . $search . '%']);
} else {
    $stmt = $pdo->query("
        SELECT f.id, f.nom AS fromage, c.nom AS categorie, f.description, f.image_url
        FROM cheeses f
        LEFT JOIN categories c ON f.categorie_id = c.id
        ORDER BY f.id ASC
    ");
}

$fromages = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($fromages as $fromage) 
{
    echo "<div class='card'>";
    echo "<a><div class='card-text'>";
    echo "<h2>{$fromage['id']}. {$fromage['fromage']}</h2>";
    echo "<h3>" . nl2br(htmlspecialchars($fromage['description'])) . "</h3>";
    
    if (!empty($fromage['image_url'])) 
    {
        echo "<img src='{$fromage['image_url']}' alt='Image de {$fromage['fromage']}'>";
    }
    echo "<h4>{$fromage['categorie']}</h4>";
    echo "</div>";
    echo "</div>";
}
?>