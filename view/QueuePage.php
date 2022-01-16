<?php require_once dirname(__DIR__).'/controller/PrivatePageController.php'; processPrivatePage();  ?>
<html>
    <head>
        <link rel="stylesheet" href="/css/style.css">
        <script src="/js/ajax.js" type="text/javascript"></script>
    </head>
    <div class="wrapper">
        <body>
            <header>
                <h1>
                    Очередь на автомойку    
                </h1>        
            </header>
            <?php require_once dirname(__DIR__).'/view/Header.php'?>
            
            <main>
                <?php include dirname(__DIR__).'/controller/GetQueueListController.php' ?>
            </main>
            <button onclick="addToQueue(`<?php echo($_SESSION['login']); ?>`)">Записаться</button>
            <footer>
                Just a footer
            </footer>
        </body>
    </div>
</html>