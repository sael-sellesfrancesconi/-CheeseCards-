<?php
    if (isset($_SESSION['error-options'])) 
    {
        echo "<h3 style='color:red;'>" . $_SESSION['error-options'] . "</h3>";
        $_SESSION['error-options'] = "";
    }
    if (isset($_SESSION['success-options'])) 
    {
        echo "<h3 style='color:green;'>" . $_SESSION['success-options'] . "</h3>";
        $_SESSION['success-options'] = "";
    }
?>