<ul class="authFields">
<?php
    session_start();
    if(isset($_SESSION['login']))
    {
        $login = $_SESSION['login'];
        echo("<button class='btn-hover color-8'><a class='register'>{$login}</a></button>");
        echo("<button class='btn-hover color-8'><a href='/controller/Logout.php'> Выйти </a></button>");                
    } 
    else
        echo("<button class='btn-hover color-8'><a href='/view/Register.php'> Регистрация </a> </button>
        <button class='btn-hover color-8'><a href='/view/Login.php'> Войти</a> </button>"); ?>
</ui>