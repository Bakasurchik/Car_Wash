

<html>
    <head>
        <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/button.css">
    </head>
    <div class="wrapper">
        <body>
            <div class="lds-ring"></div>
            <header>
                <h1>
                    Бронирование очереди на автомойку    
                </h1>        
            </header>
            <?php require_once dirname(__DIR__).'/view/Header.php'?>

            <main>
                <div class = "video">
                        <video  width="100%" height="auto" preload="auto" muted="muted" autoplay="autoplay" loop="loop" >
                            <source src="/video/main_page_car_background.webm" type="video/webm"></source>
                        </video>
   
                </div>
                <div class="QP">
                    <button class="btn-hover color-9"><a href="/view/QueuePage.php">Записаться</a></button>
                
                </div>
                <div class="OTSTUP">
                </div>   
                
                
            </main>
                
            <footer >
                <?php require_once dirname(__DIR__).'/view/Footer.php'?>
            </footer>
            <?php require_once dirname(__DIR__).'/view/Preloader.php'?>
        </body>
    </div>
</html>