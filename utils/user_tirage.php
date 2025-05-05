<?php
if (!isset($_SESSION['user'])) 
{
    header("Location: index.php?p=connect");
    exit;
}

$username = $_SESSION['user'];

$stmt = $pdo->prepare("SELECT id, last_draw FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

$user_id = $user['id'];
$last_draw = $user['last_draw'];

$can_draw = false;
if (!$last_draw || strtotime($last_draw) < time() - 3600) 
{
    $can_draw = true;
}

$cards = [];

if ($can_draw) 
{
    $stmt = $pdo->query("SELECT id FROM cheeses ORDER BY RAND() LIMIT 2");
    $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($cards as $card) 
    {
        $pdo->prepare("INSERT INTO collections_cheeses (id_user, id_cheese, date) VALUES (?, ?, NOW())")
            ->execute([$user_id, $card['id']]);
    }

    $pdo->prepare("UPDATE users SET last_draw = NOW() WHERE id = ?")->execute([$user_id]);
}
?>