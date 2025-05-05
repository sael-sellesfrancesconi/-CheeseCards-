<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitNewPassword'])) 
{
    include("./db_access.php");

    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) 
    {
        $_SESSION['error-options'] = "Token CSRF invalide.";
        header("Location: ../home.php");
        exit;
    }

    $name = $_SESSION['user'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    if (empty($name) || empty($oldPassword)) 
    {
        $_SESSION['error-options'] = "Tous les champs sont requis.";
        header("Location: ../home.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$name]);
    $user = $stmt->fetch();

    if (!password_verify($oldPassword, $user['password'])) 
    {
        $_SESSION['error-options'] = "Mot de passe incorrect.";
        header("Location: ../home.php");
        exit;
    }

    $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->execute([$newPasswordHashed, $name]);

    $_SESSION['success-options'] = "Mot de passe mis à jour.";

    header("Location: ../home.php");
    exit;
}
header("Location: ../index.php");
?>