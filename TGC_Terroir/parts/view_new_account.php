<main>
    <title> CheeseCards - Nouveau compte </title>
    <div id="text">
        <h1>S' <b class="special">inscrire</b></h1>
    </div>
    
    <form method="post" action="./new-account.php">
            
        <h3> Identifiant </h3>
        <input type="text" name="id" required>
                
        <h3>Mot de passe</h3>
        <input type="password" name="mdp2" id="mdp2" required>
        
        <h3>Confirmer le mot de passe</h3>
        <input type="password" name="mdp3" id="mdp3" required>
    
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="submit" name="new-account" value="S'inscrire">
        
        <?php
            if (isset($_SESSION['error'])) {
                echo "<h3 style='color:red;'>" . $_SESSION['error'] . "</h3>";
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo "<h3 style='color:green;'>" . $_SESSION['success'] . "</h3>";
                unset($_SESSION['success']);
            }
        ?>
    </form>
</main>