<?php
require_once dirname(__DIR__).'/DBManage/DBCore.php';
    require_once dirname(__DIR__).'/model/QueueModel.php';

    $dbConnection = dbConnection::tryDefaultConnection();
            $queue = new Queue(array());
            $queue->fillFromDb("queue_data");
            $queue_list =
                    "
                        <div class='queueNote'>
                            <p class='number' id='queue_size'>{$queue->queueSize()}<br></p>
                            <p>в очереди</p>
                        </div>
                    ";
            for($i = 0; $i < $queue->queueSize(); $i++)
            {
                $queue_note = $queue->getQueueNoteByArrayIndex($i);
                $index = $queue_note->queueOrderIndex();
                $strInd = strval($index);
                $strLogin = $queue_note->user_login();
                $strId = $queue_note->id();
                if($_SESSION['login'] == $queue_note->user_login())
                    $queue_list .=
                    "
                        <div class='queueNode'>
                            <p>Номер в очереди: {$strInd}</p>
                            <p>Имя аккауна: {$strLogin}</p>
                            <p>Уникальный Id: {$strId}</p>
                            <button class='deleteNote'  id='deleteNote'>Удалить запись</button>
                        </div>
                    "; 
                else
                    $queue_list .=
                        "
                            <div class='queueNode'>
                                <p>Номер в очереди: {$strInd}</p>
                                <p>Имя аккауна: {$strLogin}</p>
                                <p>Уникальный Id: {$strId}</p>
                            </div>
                        "; 
            }
            echo($queue_list);
        ?>