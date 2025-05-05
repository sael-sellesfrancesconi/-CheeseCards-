<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitDeleteAccount'])) 
{
    include("./db_access.php");

    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) 
    {
        $_SESSION['error-options'] = "Token CSRF invalide.";
        header("Location: ../home.php");
        exit;
    }

    $name = $_SESSION['user'];
    $password = $_POST['password'];

    if (empty($name) || empty($password)) 
    {
        $_SESSION['error-options'] = "Tous les champs sont requis.";
        header("Location: ../home.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$name]);
    $user = $stmt->fetch();

    if (!password_verify($password, $user['password'])) 
    {
        $_SESSION['error-options'] = "Mot de passe incorrect.";
        header("Location: ../home.php");
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM users WHERE username = ?");
    $stmt->execute([$name]);

    header("Location: ./user_deconnect.php");
    exit;
}
header("Location: ../index.php");
?>