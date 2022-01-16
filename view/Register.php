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
                        $text = $_GET["answer_text"];
                        echo("<label style='margin-left: 50px;' class='red'>{$text}</label>");
                     ?>
                <form class="loginForm" method="post" action="/controller/RegistrerController.php">
                    <ul class="verticalFormElements">                    
                        <li>
                            <label for="phone_num">Телефон</label>      
                            <br>
                            <input name="phone_num" type="text"    placeholder="8982925533" id="phone_num" required >
                        </li>
                        <li>
                            <label for="email">Email</label>     
                            <br>
                            <input name="email" type="email"  placeholder="sample@sample.ru" id="email" required>
                        </li>
                        <li>
                            <label>Login</label>
                            <br>
                            <input type="text" placeholder="Login" name="login" required>
                        </li>
                        <li>
                            <label>Пароль</label>
                            <br>
                            <input type="password" placeholder="*******" name="password" required>
                        </li>
                            <br>
                        <input type="submit" name="register" value="Register"> <button><a href="/view/MainPage.php">Back</a></button>
                    </ul>
                </form>
        </body>
    </div>
</html>