<html>
    <head>
        <head>
            <link rel="stylesheet" href="/css/style.css">
        </head> 
    </head>
    <div class="authWrapper">
        <body>
            <div class="authContainer">
                <?php 
                     if(isset($_GET["answer_text"]) && isset($_GET["answer_val"]) && $_GET["answer_val"] == 0)
                        echo("<label style='margin-left: 50px;' class='red'>{$_GET["answer_text"]}</label>");
                     ?>
                <form class="loginForm" method="post" action="/controller/LoginController.php">
                    <br>
                    <label>Login</label>
                    <input type="text" name="loginText">
                    <label>Password</label>
                    <input type="password" name="password">
                    <br>
                    <input type="submit" name="login" value="Login"> <button> <a href="/static/MainPage.php">Back</a></button>
                    <br>
                    <a href="/view/passrestoring.php">Forgot the password</a>
                </form>
            </div>
        </body>
    </div>
</html>