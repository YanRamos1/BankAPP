<?php

namespace Includes;

use PDO;
use PDOException;

class Database
{

    //run test



    public static function connect()
    {
        try {
            $host = 'localhost';
            $dbname = 'bd_bank';
            $username = 'root';
            $password = '';
            $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
            return $conn;

        } catch (PDOException $e) {
            $code = $e->getCode();
            return 'Error:' . $code;
        }
    }


}
