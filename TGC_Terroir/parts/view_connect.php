<main>
    <title> CheeseCards - Se connecter </title>
    <div id="text">
        <h1>Se <b class="special">connecter</b></h1>
    </div>
    
    <form method="post" action="./connect.php">
        
        <h3> Identifiant </h3>
        <input type="text" name="id" required>
                
        <h3>Mot de passe</h3>
        <input type="password" name="mdp1" id="mdp1" required>
    
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="submit" name="connect" value="Se connecter">
        
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