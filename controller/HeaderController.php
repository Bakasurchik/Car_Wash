<?php
    session_start();
    if(isset($_SESSION['login']))
    {
        $login = $_SESSION['login'];
        echo("<ul class='register'>{$login}</ul>");
        echo("<ul class='login'><a href='/controller/Logout.php'> Logout </a></ul>");                
    } 
    else
        echo("<ul class='register'><a href='/view/Register.php'> Register </a> </ul>
    <ul class='login'><a href='/view/Login.php'> Login</a> </ul>"); ?>