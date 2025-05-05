<?php
    if (isset($_SESSION['error'])) 
    {
        echo "<h3 style='color:red;'>" . $_SESSION['error'] . "</h3>";
        $_SESSION['error'] = "";
    }
    if (isset($_SESSION['success'])) 
    {
        echo "<h3 style='color:green;'>" . $_SESSION['success'] . "</h3>";
        $_SESSION['success'] = "";
    }
?>