<html>
    <head>
        <head>
            <link rel="stylesheet" href="/css/style.css">
        </head> 
    </head>
    <div class="authWrapper">
        <body>
            <div class="registerContainer">
                <?php 
                     if(isset($_GET["answer_text"]) && isset($_GET["answer_val"]) && $_GET["answer_val"] == 0)
                        $text = $_GET["answer_text"];
                        echo("<label style='margin-left: 50px;' class='red'>{$text}</label>");
                     ?>
                <form class="authForm" method="post" action="/controller/RegistrerController.php">
                    <br>
                    <label for="phone_num">Телефон</label>      
                    <input name="phone_num" type="text"    placeholder="8982925533" id="phone_num" required >
                    <br>
                    <label for="email">Email</label>     
                    <input name="email" type="email"  placeholder="sample@sample.ru" id="email" required>
                    <br>
                    <label>Login</label>
                    <input type="text" placeholder="Login" name="login" required>
                    <label>Пароль</label>
                    <input type="password" placeholder="*******" name="password" required>
                    <br>
                    <input type="submit" name="register" value="Register"> <a href="/view/MainPage.php"><button>Back</button></a>
                </form>
            </div>
        </body>
    </div>
</html>