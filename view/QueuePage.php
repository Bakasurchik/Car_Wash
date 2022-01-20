<?php require_once dirname(__DIR__).'/controller/PrivatePageController.php'; processPrivatePage();  ?>
<html>
    <head>
        <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
        <link rel="stylesheet" href="/css/style.css">
        
    </head>
    <div class="wrapper">
        <body>
            <header>
                <h1>
                    Очередь на автомойку    
                </h1>        
            </header>
            <?php require_once dirname(__DIR__).'/view/Header.php'?>
            
            <main id="queue_main_cont">
                <?php include dirname(__DIR__).'/controller/GetQueueListController.php' ?>
            </main>
            <button class="buton" onclick="addToQueue(`<?php echo($_SESSION['login']); ?>`)">Записаться на мойку авто</button>
            <footer>
                <?php require_once dirname(__DIR__).'/view/Footer.php'?>
                <script src="/js/ajax.js" type="text/javascript"></script>
            </footer>
        </body>
    </div>
</html>