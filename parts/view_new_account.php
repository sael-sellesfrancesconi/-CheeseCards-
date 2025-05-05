<title> S'inscrire </title>
<main>
    <form method="post" action="./utils/user_new_account.php">
            
        <h3> Identifiant </h3>
        <input type="text" name="id" required>
                
        <h3>Mot de passe</h3>
        <input type="password" name="mdp2" id="mdp2" required>
        
        <h3>Confirmer le mot de passe</h3>
        <input type="password" name="mdp3" id="mdp3" required>
    
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="submit" name="new-account" value="S'inscrire">
        
        <?php include('display_error_or_success.php'); ?>
    </form>
</main>