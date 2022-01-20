

<html>
    <head>
        <link rel="stylesheet" href="/css/style.css">
        
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
                
                <div class="QP">
                    <video class='center' width="100%" height="auto" preload="auto" muted="muted" autoplay="autoplay" loop="loop" poster="bg/daisy-stock-poster.jpg">
                        <source src="/video/main_page_car_background.mp4" type="video/mp4"></source>
                        <source src="/video/main_page_car_background.webm" type="video/webm"></source>
                    </video>

                    <a href="/view/QueuePage.php"><button>Записаться</button></a>
                    
                </div>
                
            </main>

            <footer>
                Just a footer
            </footer>
            <?php require_once dirname(__DIR__).'/view/Preloader.php'?>
        </body>
    </div>
</html>