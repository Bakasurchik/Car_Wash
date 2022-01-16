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

    public function getTableColumns(string $table)
    {
        return $this->query("SHOW COLUMNS FROM {$table};");
    }


    public function addToTable(string $table, array $values)
    {
        $fields = $this->isConnectionSuccessful() ? $this->getTableColumns($table) : false;
        if(!$fields)
            return error_log("failed to get DB columns");
        $fieldsStr = "(";
        mysqli_fetch_array($fields);//убираем id
        while($row = mysqli_fetch_array($fields))
        {
            $fieldsStr .= "{$row['Field']},";
        }
        $fieldsStr .= ")";
        $valuesStr = "(";
        foreach($values as &$val)
        {
            $valuesStr .= "'{$val}',";
        }
        $valuesStr .= ")";
        $result = $this->query("INSERT INTO {$this->_database}.{$table} {$fieldsStr} VALUES {$valuesStr};");
    }


    public function selectAllFromTable(string $tableName)
    {
        return $this->select("*",$tableName);
    }

    

    public function select(string $selector,string $tableName, string $condition = "", string $orderBy = "")
    {
        $queryStr = "SELECT {$selector} FROM {$this->_database}.{$tableName}";
        if($condition != "")
            $queryStr .= " WHERE {$condition}";
        if($orderBy != "")
        {
            $queryStr .= " ORDER BY {$orderBy}";
        }
        $queryStr .= ";";
        return $this->query($queryStr);
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