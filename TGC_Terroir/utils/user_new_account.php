<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new-account'])) {
    
    $pdo = new PDO('mysql:host=localhost;dbname=u211312457_fromage;charset=utf8', 'u211312457_fromage', 'bPLuPVNDK6qvyKU', [
        /*PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION*/
    ]);
    
    // Vérif token CSRF
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        $_SESSION['error'] = "Token CSRF invalide.";
        header("Location: ./index.php?p='new-account'");
        exit;
    }

    $id = trim($_POST['id']);
    $mdp2 = $_POST['mdp2'];
    $mdp3 = $_POST['mdp3'];

    if (empty($id) || empty($mdp2) || empty($mdp3)) {
        $_SESSION['error'] = "Tous les champs sont requis.";
        header("Location: ./index.php?p=new-account");
        exit;
    }

    if ($mdp2 !== $mdp3) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: ./index.php?p=new-account");
        exit;
    }

    if (strlen($mdp2) < 4) {
        $_SESSION['error'] = "Le mot de passe doit contenir au moins 6 caractères.";
        header("Location: ./index.php?p=new-account");
        exit;
    }

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$id]);
    if ($stmt->fetchColumn() > 0) {
        $_SESSION['error'] = "Cet identifiant est déjà utilisé.";
        header("Location: ./index.php?p=new-account");
        exit;
    }

    $hash = password_hash($mdp2, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    
    if ($stmt->execute([$id, $hash])) {
        $_SESSION['success'] = "Inscription réussie ! Vous pouvez vous connecter.";
    } else {
        $_SESSION['error'] = "Erreur lors de l'inscription.";
    }

    header("Location: ./index.php?p=new-account");
    exit;
}
