<?php
    session_start();
    if(isset($_SESSION['login']))
    {
        $login = $_SESSION['login'];
        echo("<ul class='register'>{$login}</ul>");
        echo("<ul class='login'><a href='/static/Auth/logout.php'> Logout </a></ul>");                
    } 
    else
        echo("<ul class='register'><a href='/static/Auth/register.php'> Register </a> </ul>
    <ul class='login'><a href='/static/Auth/login.php'> Login</a> </ul>"); ?>
