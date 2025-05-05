<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitNewName'])) 
{
    include("./db_access.php");

    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) 
    {
        $_SESSION['error-options'] = "Token CSRF invalide.";
        header("Location: ../home.php");
        exit;
    }

    $oldName = $_SESSION['user'];
    $newName = $_POST['newName'];
    $password = $_POST['password'];

    if (empty($newName) || empty($password)) 
    {
        $_SESSION['error-options'] = "Tous les champs sont requis.";
        header("Location: ../home.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$oldName]);
    $user = $stmt->fetch();

    if (!password_verify($password, $user['password'])) 
    {
        $_SESSION['error-options'] = "Mot de passe incorrect.";
        header("Location: ../home.php");
        exit;
    }

    $newPasswordHashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ? WHERE username = ?");
    $stmt->execute([$newName, $newPasswordHashed, $oldName]);

    $_SESSION['user'] = $newName;
    $_SESSION['success-options'] = "Identifiant mis à jour.";

    header("Location: ../home.php");
    exit;
}
header("Location: ../index.php");
?>