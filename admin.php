<?php 
include("./utils/ini_session.php"); 
include("./utils/db_access.php");

$db_query = $pdo->prepare("SELECT admin FROM users WHERE username = ?");
$db_query->execute([$_SESSION['user']]);
$db_user = $db_query->fetch();

if (!$db_user || $db_user["admin"] != 1) 
{
    header("Location: ./index.php");
    exit();
} 


$action = $_GET['action'] ?? 'users';
$username = $_GET['u'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rename']) && $username) {
    $newname = trim($_POST['newname']);
    $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE username = ?");
    $stmt->execute([$newname, $username]);
    echo "{$newname}{$username}";
    header("Location: admin.php"); exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && $username) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE username = ?");
    $stmt->execute([$username]);
    header("Location: admin.php"); exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_card']) && $username) {
    $card = trim($_POST['card']);
    $stmt = $pdo->prepare("INSERT INTO cards (username, card_name) VALUES (?, ?)");
    $stmt->execute([$username, $card]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_card']) && $username) {
    $card = trim($_POST['card']);
    $stmt = $pdo->prepare("DELETE FROM cards WHERE username = ? AND card_name = ?");
    $stmt->execute([$username, $card]);
}
?>

<head>
    <title>CheeseCards - Admin</title>
    <link rel="stylesheet" href="./public/styles_header.css">
    <link rel="stylesheet" href="./public/styles_common_pages.css">
    <?php include("./utils/common_head.php"); ?>
</head>

<body data-aos="fade-in" class="cheese">
    <?php include("./parts/header_admin.php"); ?>

    <section id="admin-container">
        <main>
            <?php if ($action === 'users'): ?>
                <h1>Utilisateurs</h1>
                <section class="content">
                    <?php
                    $stmt = $pdo->query("SELECT * FROM users");
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($users as $u) {
                        echo "<div class='card admin'>";
                        echo "<h2>{$u['username']}</h2>";
                        echo "<h3>Id numérique : {$u['id']}</h3>";
                        echo "<h3>Date d'inscription : {$u['date']}</h3>";
                        echo "<a class='admin' href='?u={$u['username']}&action=cartes'>Voir les cartes</a>";
                        echo "<form method='POST' class='admin' action='?u=" . urlencode($u['username']) . "&action=users'>";

                        echo "<input name='newname' type='text' placeholder='Nouveau nom'>";
                        echo "<button name='rename'>Changer de nom</button>";
                        echo "</form>";
                        
                        echo "<form method='POST' class='admin' action='?u=" . urlencode($u['username']) . "&action=users'>";
                        echo "<button name='delete'>Supprimer le compte</button>";
                        echo "</form>";

                        echo "</div>";
                    }
                    ?>
                </section>
            <?php elseif ($action === 'cartes' && $username): ?>
                <a href="admin.php">⫷⫥ Retour</a>
                <h1>Cartes de <?= htmlspecialchars($username) ?></h1>
                <section class="content-home">
                    <?php
                    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
                    $stmt->execute([$username]);
                    $user = $stmt->fetch();
                    
                    $user_id = $user['id'];
                    
                    $db_query = $pdo->prepare("SELECT * FROM collections_cheeses WHERE id_user = ?");
                    $db_query->execute([$user_id]);
                    $cheeses = $db_query->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($cheeses as $cheese_entry) 
                    {
                        $db_query = $pdo->prepare("
                            SELECT 
                                f.id,
                                f.nom AS fromage,
                                f.description,
                                f.image_url,
                                c.nom AS categorie
                            FROM cheeses f
                            LEFT JOIN categories c ON f.categorie_id = c.id
                            WHERE f.id = ?
                        ");
                        $db_query->execute([$cheese_entry['id_cheese']]);
                        $fromage = $db_query->fetch();
                    
                        echo "<div class='card-home'>";
                        echo "<a><div class='card-text'>";
                        echo "<h2>{$fromage['fromage']}</h2>";
                        echo "<h3>" . nl2br(htmlspecialchars($fromage['description'])) . "</h3>";
                    
                        if (!empty($fromage['image_url'])) 
                        {
                            echo "<img src='{$fromage['image_url']}' alt='Image de {$fromage['fromage']}'>";
                        }
                        echo "<h4>{$fromage['categorie']}</h4>";
                        echo "</div></a>";
                        echo "</div>";
                    }
                    ?>
                </section>
            <?php endif; ?>
        </main>
    </section>

    <script src="./public/script_options.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>
