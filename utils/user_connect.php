<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connect'])) 
{
    include("./db_access.php");

    // Vérif token CSRF
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) 
    {
        $_SESSION['error'] = "Token CSRF invalide.";
        header("Location: ../index.php?p=connect");
        exit;
    }

    $id = trim($_POST['id']);
    $mdp = $_POST['mdp1'];

    if (empty($id) || empty($mdp)) 
    {
        $_SESSION['error'] = "Tous les champs sont requis.";
        header("Location: ../index.php?p=connect");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($mdp, $user['password'])) 
    {
        $_SESSION['error'] = "Identifiant ou mot de passe incorrect.";
        header("Location: ../index.php?p=connect");
        exit;
    }
    
    $_SESSION['user'] = $user['username'];
    $_SESSION['success'] = "Connexion réussie !";
    
    header("Location: ../home.php");
    exit;
}
?>
