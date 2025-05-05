<header data-aos="fade-down">
    <h1>Magasin</h1>
    <div>
        <?php 
        session_start();
        include("./utils/db_access.php");
        
	    $db_query = $pdo->prepare("SELECT admin FROM users WHERE username = ?");
        $db_query->execute([$_SESSION['user']]);
        $db_user = $db_query->fetch();
        
        if ($db_user["admin"] == 1) 
        {
            echo '<a href="./admin.php"><i class="fa-solid fa-user-tie"></i></a>';
        } 
	    ?>
        <?php if (!empty($_SESSION['user'])): ?>
            <a href="./home.php"><i class="fa-solid fa-user"></i></a>
        <?php endif; ?>
        <a href="./codex.php"><i class="fa-solid fa-book"></i></a>
        <a href="./index.php"><i class="fa-solid fa-house"></i></a>
    </div>
</header>