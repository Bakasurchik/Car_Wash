<?php
    require_once dirname(__DIR__).'/DBManage/DBCore.php';
    require_once dirname(__DIR__).'/model/AuthModel.php';
    $dbConnection = dbConnection::tryDefaultConnection();
        if ( isset( $_POST['login'] ) ) 
        { 
            $username =    filter_var($_POST['login'],FILTER_SANITIZE_STRING);
            $password =    $_POST['password']; 
            //$hashed_password =  password_hash($_POST['password'], PASSWORD_DEFAULT); 
        
           $user = User::getUserFromDB($username);

            if($user && $is_correct_password = password_verify($password,$user->password_hash()))
            {
                session_start();
                $_SESSION['login'] = $user->login();
                header("Location: /view/MainPage.php");
                Exit();
            }
            else
            {
                header("Location: /view/login.php?answer_val=0&answer_text='Wrong input data.'");
                Exit();
            }
        }
     ?>