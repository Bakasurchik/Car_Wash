<?php 
require_once dirname(__DIR__).'/DBManage/DBCore.php';
class QueueNote
{
    public function __construct(int $ind,int $userId)
    {
        $this->_queueNoteIndex = $ind;
        $this->_userId = $userId;
    }

    public function toArray()
    {
        return array($this->_queueNoteIndex,$this->_userId);
    }

    private int $_queueNoteIndex;
    private int $_userId;
}

class Queue
{
    public function __construct(array $queueElements)
    {
        $this->_queue = $queueElements;
        $this->_dbConnect = DBConnection::tryDefaultConnection();
    }

    public function addUserToQueue(QueueNote $item)
    {
        array_push($this->_queue,$item);
        $this->_addUserToDB($item);
    }

    public function fillFromDb(string $table)
    {
        $result = $this->_dbConnect->select("*","queue_data");
        if(!$result)
            return false;
        $array = mysqli_fetch_array($result);
        if(count($array))
        {
            foreach($array as &$row) 
            {
                $id = $row['id'];
                $password_hash = $row['password_hash'];
                $email = $row['email'];
                $phone_num = $row['phone_num'];
            }
        }
        else
            return false;
    }

    private function _addUserToDB(QueueNote $item)
    {
        $this->_dbConnect->addToTable("queue_data",$item->toArray());
    }

    private array $_queue;
    private DBConnection $_dbConnect;
}
?>