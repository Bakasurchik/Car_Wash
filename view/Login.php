<html>
    <head>
        <head>
            <link rel="stylesheet" href="/css/style.css">
        </head> 
    </head>
    <div class="authContainer">
        <body>
                <?php 
                     if(isset($_GET["answer_text"]) && isset($_GET["answer_val"]) && $_GET["answer_val"] == 0)
                        echo("<label style='margin-left: 50px;' class='red'>{$_GET["answer_text"]}</label>");
                     ?>
                <form class="loginForm" method="post" action="/controller/LoginController.php">
                    <ul class="verticalFormElements">
                        <li> 
                            <label>Login</label>
                            <br>
                            <input type="text" name="login">
                        </li>
                        <li>
                            <label>Password</label>
                            <br>
                            <input type="password" name="password">
                        </li>
                        <input type="submit" name="loginButton" value="Login"></input>
                        <button><a href="/view/MainPage.php">Back</a></button>
                    </ul>   
                    <a href="/view/passrestoring.php">Forgot the password</a>
                </form>
        </body>
    </div>
</html>