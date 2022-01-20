<?php
//Включение удалённых файлов единожды 
require_once dirname(__DIR__).'/DBManage/DBCore.php'; 
require_once dirname(__DIR__).'/model/QueueModel.php';

    $dbConnection = DBConnection::tryDefaultConnection();
            $queue = new Queue(array());
            $queue->fillFromDb("queue_data");
            $queue_list =
                    "
                        <div class='queueNote'>
                            <p class='number' id='queue_size'>{$queue->queueSize()}<br></p>
                            <p>в очереди</p>
                        </div>
                        <div class='gridqueueNode'>
                    ";
            for($i = 0; $i < $queue->queueSize(); $i++)
            {
                $queue_note = $queue->getQueueNoteByArrayIndex($i);
                $index = $queue_note->queueOrderIndex();
                $strInd = strval($index);
                $strLogin = $queue_note->_user_login;
                $strId = $queue_note->id();
                if($_SESSION['login'] == $queue_note->_user_login)
                    $queue_list .=
                    "
                        <div class='queueNode'>
                            <p>{$strInd}</p>
                            <p>{$strLogin}</p>
                            <button class='deleteNote'  id='deleteNote'>Удалить запись</button>
                        </div>
                    "; 
                else
                    $queue_list .=
                        "
                            <div class='queueNode'>
                                <p>{$strInd}</p>
                                <p>{$strLogin}</p>
                            </div>
                        "; 
            }
            $queue_list .= 
                    "
                        </div>
                    ";
            echo($queue_list);
        ?>