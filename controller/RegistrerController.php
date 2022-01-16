<?php
    require_once dirname(__DIR__).'/DBManage/DBCore.php';
    require_once dirname(__DIR__).'/model/AuthModel.php';
    $dbConnection = dbConnection::tryDefaultConnection();
        if ( isset( $_POST['register'])) 
        {
            $mail = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $username =     filter_var($_POST['login'],FILTER_SANITIZE_STRING);
            $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $phone_num = filter_var($_POST['phone_num'],FILTER_SANITIZE_STRING);
            $user = User::getUserFromDB($username);
            if($user)
            {
                header("Location: /view/Register.php?answer_val=0&answer_text='That login already exist.'");
                Exit();
            }
            else
            {
                $newUser = new User($username,$hashed_password,$mail,$phone_num); 
                $result = addNewUser($newUser);
                if($result)
                {
                    session_start();
                    $_SESSION['login'] = $username;
                    header("Location: /view/MainPage.php");
                    Exit();
                }
                header("Location: /view/register.php?answer_val=0&answer_text='Something went wrong, try again later.'");
                error_log("Failed to add new user");
                Exit();
            }
        }
?>
    