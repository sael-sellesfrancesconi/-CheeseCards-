<?php include("./utils/ini_session.php"); ?>
<head>
    <title> CheeseCards - Codex </title>
</head>
<body>
    <div id="text">
        <h1>Codex</h1>
        <?php
        include("./utils/db_access.php");
        $stmt = $pdo->query("
            SELECT 
                f.id,
                f.nom AS fromage,
                c.nom AS categorie,
                f.description,
                f.image_url
            FROM cheeses f
            LEFT JOIN categories c ON f.categorie_id = c.id
            ORDER BY f.id ASC
        ");
        
        $fromages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($fromages as $fromage) {
            echo "<h2>{$fromage['id']}. {$fromage['fromage']} - {$fromage['categorie']}</h2>";
            echo "<h3>" . nl2br(htmlspecialchars($fromage['description'])) . "</h3>";
            if (!empty($fromage['image_url'])) {
                echo "<img src='{$fromage['image_url']}' alt='Image de {$fromage['fromage']}' style='max-width:200px;'><br>";
            }
            echo "<br><br>";
        }?>
    </div>
</body>
