<header data-aos="fade-down">
	<h1> Espace Personnel </h1>
	<h2><a href="./tirage.php" class="draw-button"> Tirer des cartes </a></h2>
	<div>
	    <?php 
	    $db_query = $pdo->prepare("SELECT admin FROM users WHERE username = ?");
        $db_query->execute([$_SESSION['user']]);
        $db_user = $db_query->fetch();
        
        if ($db_user["admin"] == 1) 
        {
            echo '<a href="./admin.php"><i class="fa-solid fa-user-tie"></i></a>';
        } 
	    ?>
	    <a href="./shop.php"><i class="fa-solid fa-cart-shopping"></i></a>
	    <a href="./codex.php"><i class="fa-solid fa-book"></i></a>
		<a href="./index.php"><i class="fa-solid fa-house"></i></a>
	</div>
</header>