<?php 
require_once dirname(__DIR__).'/DBManage/DBCore.php';
class QueueNote
{
    public function __construct(int $id,int $ind,string $user_login)
    {
        $this->_id = $id;
        $this->_queueOrderIndex = $ind;
        $this->_user_login = $user_login;
    }

    public function toArray()
    {
        return array($this->_queueOrderIndex,$this->_user_login);
    }

    public function id()
    {
        return $this->_id;
    }

    public function queueOrderIndex()
    {
        return $this->_queueOrderIndex;
    }


    public int $_id;
    public int $_queueOrderIndex;
    public string $_user_login;
}

class Queue
{
    public function __construct(array $queueElements)
    {
        $this->_queue = $queueElements;
        $this->_dbConnect = DBConnection::tryDefaultConnection();
    }

    public function addUserToArrayOnly(QueueNote $item)
    {
        array_push($this->_queue,$item);
    }

    public function addUserToQueue(QueueNote $item)
    {
        if($this->isUserExist($item->_user_login))
            return false;
        $result =  $this->_addUserToDB($item);
        if($result)
            array_push($this->_queue,$item);
        return $result;
    }

    public function removeUserFromQueue(QueueNote $item)
    {
        $result = $this->_deleteUserFromDB($item);
        if($result)
            array_splice($this->_queue, $item->queueOrderIndex());
        return $result;
    }

    public function isUserExist(string $login)
    {
        foreach($this->_queue as &$qNote)
            if($qNote->_user_login == $login)
                return true;
        return false;
    }


    public function getQueueNoteByArrayIndex(int $index)
    {
        return $this->_queue[$index];
    }

    public function queueSize()
    {
        return count($this->_queue);
    }

    public function fillFromDb(string $table)
    {
        $this->_queue = array();
        $result = $this->_dbConnect->select("*",$table,"","queue_order_index ASC");
        if(!$result)
            return false;
        //$array = mysqli_fetch_array($result);
        while($row = mysqli_fetch_array($result))
        {
            $id = (int)$row['id'];
            $queue_order_index = (int)$row['queue_order_index'];
            $user_login = $row['user_login'];
            $this->addUserToArrayOnly(new QueueNote($id,$queue_order_index,$user_login));
        }
    }

    private function _addUserToDB(QueueNote $item)
    {
        return $this->_dbConnect->addToTable("queue_data",$item->toArray());
    }

    private function _deleteUserFromDB(QueueNote $item)
    {
        return $this->_dbConnect->deleteFromTableByPK("queue_data","user_login","'{$item->_user_login}'");
    }

    private array $_queue;
    private DBConnection $_dbConnect;
}
