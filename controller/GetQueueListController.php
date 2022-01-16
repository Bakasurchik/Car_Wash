<?php
require_once dirname(__DIR__).'/DBManage/DBCore.php';
    require_once dirname(__DIR__).'/model/QueueModel.php';

    $dbConnection = dbConnection::tryDefaultConnection();
            $queue = new Queue(array());
            $queue->fillFromDb("queue_data");
            $queue_list = "";
            for($i = 0; $i < $queue->queueSize(); $i++)
            {
                $queue_note = $queue->getQueueNoteByArrayIndex($i);
                $index = $queue_note->queueOrderIndex();
                $strInd = strval($index);
                $queue_list .=
                    "
                        <div class='queueNote'>
                            <p class='number'>{$queue->queueSize()}<br></p>
                            <p>в очереди</p>
                        </div>
                    "; 
            }
            echo($queue_list);
        ?>