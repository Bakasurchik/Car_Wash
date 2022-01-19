<?php
    require_once dirname(__DIR__).'/DBManage/DBCore.php';
    require_once dirname(__DIR__).'/model/QueueModel.php';

    $dbConnection = dbConnection::tryDefaultConnection();
        if ( isset( $_GET['add_queue_note'] ) ) 
        { 
            if(isset( $_GET['login']))
                $user_login = $_GET['login'];
            $queue = new Queue(array());
            $queue->fillFromDb("queue_data");
            $queue_order_index = $queue->queueSize();
            $queue_note = new QueueNote(0,$queue_order_index,$user_login);
            $result = $queue->addUserToQueue($queue_note);
            if($result)
            {
                header('Content-type: application/json');
                $queue_note_str = json_encode($queue_note);
                echo($queue_note_str);
            }
            else
                echo(null);
                   //'
                   // `
                   //     <div class="queueNote">
                   //         <p class="number">{$queue_note->queueOrderIndex()}<br></p>
                   //         <p>в очереди</p>
                   //     </div>
                   // `;
        }

        if ( isset( $_GET['delete_queue_note'] ) ) 
        { 
            if(isset( $_GET['login']))
                $user_login = $_GET['login'];
            $queue = new Queue(array());
            $queue->fillFromDb("queue_data");
            $queue_order_index = $queue->queueSize();
            $queue_note = new QueueNote(0,$queue_order_index,$user_login);
            $result = $queue->removeUserFromQueue($queue_note);
            if($result)
            {
                header('Content-type: application/json');
                echo(json_encode(true));
            }
            else
                echo(null);
                    //'
                   // `
                   //     <div class="queueNote">
                   //         <p class="number">{$queue_note->queueOrderIndex()}<br></p>
                   //         <p>в очереди</p>
                   //     </div>
                   // `;
        }

        

     ?>