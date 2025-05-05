<?php
session_start();

session_start();
if (!isset($_SESSION["user"])) {
    http_response_code(403);
    exit();
}

if (isset($_POST['cheese_id'])) 
{
    $_SESSION["cheese_id"] = $_POST["cheese_id"];
}?>