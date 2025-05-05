<?php
try 
{
    $db_query = $pdo->prepare("SELECT date FROM users WHERE username = ?");
    $db_query->execute([$_SESSION['user']]);
    $db_user = $db_query->fetch();
    
    if (!$db_user) 
    {
        header("Location: ./index.php");
        exit();
    } 
    
    $dateInscription = (new DateTime($db_user['date']))->format('d/m/Y');
} 
catch (PDOException $e) 
{
    die("Erreur DB.");
}?>