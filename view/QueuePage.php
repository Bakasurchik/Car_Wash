<?php require_once dirname(__DIR__).'/controller/PrivatePageController.php'; processPrivatePage();  ?>
<html>
    <head>
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
            
            <main>
                <div class="queueNote">
                    <p class="number">5<br></p>
                    <p>в очереди</p>
                </div>
                
            </main>

            <footer>
                Just a footer
            </footer>
        </body>
    </div>
</html>