<?php 
session_start();
unset($_SESSION['login']); 
header("Location: /view/MainPage.php");
Exit();
?>