<ul class="authFields">
<?php
    session_start();
    if(isset($_SESSION['login']))
    {
        $login = $_SESSION['login'];
        echo("<li><a class='register'>{$login}</a></li>");
        echo("<li><a href='/controller/Logout.php'> Выйти </a></li>");                
    } 
    else
        echo("<li><a href='/view/Register.php'> Регистрация </a> </li>
    <li><a href='/view/Login.php'> Войти</a> </li>"); ?>
</ui>