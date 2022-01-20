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

    static public function getNoteFromDB(string $login)
    {
        $dbConnection = DBConnection::tryDefaultConnection();
        $result = $dbConnection->select("*","queue_data","(queue_data.user_login LIKE '{$login}')");
        if(!$result)
            return null;
        $row = mysqli_fetch_array($result);
        if($row && count($row))
        {
            $id = $row['id'];
            $ind = $row['queue_order_index'];
            $user_login = $row['user_login'];
            return new QueueNote($id,$ind,$user_login);
        }
        else
            return null;
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
        {
            array_push($this->_queue,$item);
            $this->reorderIndexes();
        }
        return $result;
    }

    public function removeUserFromQueue(string $login)
    {
        $item = QueueNote::getNoteFromDB($login);
        $result = $this->_deleteUserFromDB($login);
        if($result)
        {
            unset($this->_queue[$item->queueOrderIndex()-1]);
            $this->reorderIndexes();
        }
        return $result;
    }

    public function isUserExist(string $login)
    {
        foreach($this->_queue as &$qNote)
            if($qNote->_user_login == $login)
                return true;
        return false;
    }

    public function reorderIndexes()
    {
        $i = 1;
        $res = true;
        foreach($this->_queue as &$it)
        {
            $it->_queueOrderIndex = $i;
            $sql = "UPDATE queue_data SET queue_order_index='{$i}' WHERE user_login='$it->_user_login';";
            $res &= $this->_dbConnect->query($sql);
            $i++;
        }
        return $res;
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
        $res = $this->_dbConnect->addToTable("queue_data",$item->toArray());
        return $res;
    }

    private function _deleteUserFromDB(string $login)
    {
        $res = $this->_dbConnect->deleteFromTableByPK("queue_data","user_login","'{$login}'");
        return $res;
    }

    private array $_queue;
    private DBConnection $_dbConnect;
}
