<?php

use function PHPSTORM_META\type;

require_once dirname(__DIR__).'/DBManage/DBCore.php';
class User 
{
    public function __construct(string $login, string $password_hash, string $email, string $phone_num)
    {
        $this->_login = $login;
        $this->_password_hash = $password_hash;
        $this->_email = $email;
        $this->_phone_num = $phone_num;
    }

    static public function getUserFromDB(string $login)
    {
        $password_hash = "";
        $email = "";
        $phone_num = "";
        $dbConnection = DBConnection::tryDefaultConnection();
        $result = $dbConnection->select("*","authdata","(authdata.login LIKE '{$login}')");
        if(!$result)
            return null;
        $row = mysqli_fetch_array($result);
        if($row && count($row))
        {
            $password_hash = $row['password_hash'];
            $email = $row['email'];
            $phone_num = $row['phone_num'];
            return new User($login,$password_hash,$email,$phone_num);
        }
        else
            return null;
    }
    public function login()
    {
        return $this->_login;
    }

    public function password_hash()
    {
        return $this->_password_hash;
    }

    public function email()
    {
        return $this->_email;
    }

    public function phone_num()
    {
        return $this->_phone_num;
    }

    private string $_login="";
    private string $_password_hash="";
    private string $_email = "";
    private string $_phone_num = "";
}


function addNewUser(User $user)
{
    $dbConnection = DBConnection::tryDefaultConnection();
    $addQuery = "INSERT INTO megalab_base.authdata
            (login, password_hash, email, phone_num) VALUES ( '{$user->login()}' , '{$user->password_hash()}' ,'{$user->email()}', '{$user->phone_num()}');";
    return $dbConnection->query($addQuery);
}


