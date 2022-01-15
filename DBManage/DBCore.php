<?php
class DBConnection
{
    public function __construct(string $host, string $user, string $password, string $database)
    {
        $this->_host = $host;
        $this->_user = $user;
        $this->_password = $password;
        $this->_database = $database;
        $dbconnect = mysqli_connect($host,$user,$password,$database);
        if($dbconnect)
        {
            $this->_dbConnect = $dbconnect;
            mysqli_set_charset($this->_dbConnect,"utf8");
        }
        else
            $this->connectionErrorHandling();
    }
    static public function tryDefaultConnection()
    {
        return new DBConnection("megalab.beget.tech","megalab_base","pAssword1!","megalab_base");
    } 
    public function isConnectionSuccessful()
    {
        if($this->_dbConnect)
            return true; 
        else
            return false;
    }

    public function select(string $selector,string $database,string $tableName, string $condition = "")
    {
        $queryStr ="";
        if($condition == "")
            $queryStr ="SELECT {$selector} FROM {$database}.{$tableName}";
        else
            $queryStr =  "SELECT {$selector} FROM {$database}.{$tableName} WHERE {$condition}";
         if($database != $this->_database)
            return false;
         return $this->query($queryStr);
    }
    
    public function selectAllFromTable(string $database,string $tableName)
    {
        return $this->select("*",$database,$tableName);
    }

    public function query(string $query)
    {
        return $this->isConnectionSuccessful() ? mysqli_query($this->_dbConnect,$query) : false;
    }

    private function connectionErrorHandling()
    {
        header("Location: /error.php");
        Exit();
    }

    private mysqli $_dbConnect;
    private string $_host;
    private string $_user;
    private string $_password;
    private string $_database;
    
}
?>