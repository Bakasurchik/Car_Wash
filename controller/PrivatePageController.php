<?php
    function processPrivatePage()
    {
        session_start();
        if(!isset($_SESSION['login']))
        {
            header("Location: /view/PrivatePageMessage.php");
            Exit();
        }
    }
?>