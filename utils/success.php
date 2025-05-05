<?php
session_start();

if (!isset($_SESSION["user"])) 
{
    header("Location: ../");
    exit();
}

if (isset($_SESSION["cheese_id"])) 
{
    include("./add_card_cheese.php");
    addCheeseCard($_SESSION["user"], $_SESSION["cheese_id"]);

    unset($_SESSION["cheese_id"]);

    echo "<h2>Merci pour votre achat ! Le fromage a été ajouté à votre collection.</h2>";
} 
else 
{
    echo "<h2>Aucun fromage sélectionné ou session expirée.</h2>";
}
?>
