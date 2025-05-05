<?php
session_start();


function addCheeseCard($username, $cheese_id)
{
    include("./db_access.php");
    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    $user_id = $user['id'];
    
    $add = $pdo->prepare("INSERT INTO collections_cheeses (id_user, id_cheese) VALUES (?, ?)");
    $add->execute([$user_id, $cheese_id]);
}?>