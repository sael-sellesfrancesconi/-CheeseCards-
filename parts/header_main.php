<header data-aos="fade-down">
    <a href="?p">
        <h1 id="title"><b class="special">Cheese</b>Cards <b class="special">!</b></h1>
    </a>
    <section id="liens_centre">
        
        <a href="./codex.php" target="_blank"><h2>Codex</h2></a>
        <a href="./shop.php" target="_blank"><h2>Boutique</h2></a>
         
        <?php if ((isset($user) && $user === false) || !isset($user)): ?>
            <a href="?p=new-account"><h2>Créer un compte</h2></a>
        <?php endif; ?>
        <?php 
        session_start();
        include("./utils/db_access.php");
        
	    $db_query = $pdo->prepare("SELECT admin FROM users WHERE username = ?");
        $db_query->execute([$_SESSION['user']]);
        $db_user = $db_query->fetch();
        
        if ($db_user["admin"] == 1) 
        {
            echo '<a href="./admin.php"><h2>Admin</h2></a>';
        } 
	    ?>

    </section>
    <section>
        <?php
        if ((isset($user) && $user === false) || !isset($user)) 
        {
            $page = '?p=connect'; 
            $pbn = 'Se connecter';
        } 
        else 
        {
            $page = './home.php'; 
            $pbn = 'Mon compte';
        }?>
        <a id="bouton" href="<?= $page ?>"><?= $pbn ?></a>
    </section>
</header>
