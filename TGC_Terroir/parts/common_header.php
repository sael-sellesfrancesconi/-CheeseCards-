<header>
    <a href="?p">
        <h1><b class="special">Cheese</b>Cards <b class="special">!</b></h1>
    </a>
    <section id="liens_centre">
        
        <a href="./codex.php" target="_blank"><h2>Codex</h2></a>
        <a href="./shop.php" target="_blank"><h2>Boutique</h2></a>
         
        <?php if ((isset($user) && $user === false) || !isset($user)): ?>
            <a href="?p=new-account"><h2>Créer un compte</h2></a>
        <?php endif; ?>
        
    </section>
    <section>
        <?php
        if (isset($_GET['p']) && $_GET['p'] === 'account') {
            $page = 'deconnect';
            $pbn = 'Se deconnecter';
        } elseif ($user === true) {
            $page = 'account'; 
            $pbn = 'Mon compte';
        } else {
            $page = 'connect'; 
            $pbn = 'Se connecter';
        }?>
        <a id="bouton" href="?p=<?= $page ?>"><?= $pbn ?></a>
    </section>
</header>
