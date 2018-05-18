<?php 
    session_start();
    $_SESSION['userID'] = "";
    header('Location: ../index.php')
?>