<title> Se connecter </title>
<main>
    <form method="post" action="./utils/user_connect.php">
        
        <h3> Identifiant </h3>
        <input type="text" name="id" required>
                
        <h3>Mot de passe</h3>
        <input type="password" name="mdp1" id="mdp1" required>
    
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="submit" name="connect" value="Se connecter">
        
         <?php include('display_error_or_success.php'); ?>
    </form>
</main>