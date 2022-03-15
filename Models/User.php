<?php

namespace Models;

use Composer\Autoload\ClassLoader;
use Exception;
use Includes\Database;

class User
{
    public $id_user;
    public $first_name;
    public $last_name;
    public $password;
    public $city;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->id_user = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->password = null;
        $this->city = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

    public static function getById($id_user)
    {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM users WHERE id_user = :id";
            $req = $db->prepare($sql);
            $req->bindParam(':id', $id_user);
            $req->execute();
            $user = $req->fetchObject();
            return $user;
        } catch (Exception $e) {
            echo $e->getCode();
            return new User();
        }
    }
    public function save(User $user){
        $sql = 'INSERT INTO users (first_name, last_name, password, city, created_at, deleted_at) VALUES (:first_name, :last_name, :password, :city, :created_at, :updated_at)';
        $db = Database::connect();
        $req = $db->prepare($sql);
        $req->bindParam(':first_name', $this->first_name);
        $req->bindParam(':last_name', $this->last_name);
        $req->bindParam(':password', $this->password);
        $req->bindParam(':city', $this->city);
        $req->bindParam(':created_at', $this->created_at);
        $req->bindParam(':updated_at', $this->updated_at);
        $req->execute();
        return $user;
    }

    public static function all()
    {
        try {
            $db = Database::connect();
            //count account by id user sql

            $sql = "SELECT * FROM users";
            $req = $db->prepare($sql);
            $req->execute();
            $users = $req->fetchAll(\PDO::FETCH_CLASS);
            echo '<pre>';
            print_r($users);
            echo '</pre>';

            return $users;
        } catch (Exception $e) {
            return $e->getCode();
        }

    }

    //get User and Account by id user
    public function getUserAccountById($id_user)
    {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM users join accounts a on users.id_user = a.id_user WHERE users.id_user = :id";
            $req = $db->prepare($sql);
            $req->bindParam(':id', $id_user);
            $req->execute();
            $user = $req->fetchObject();
            return $user;
        } catch (Exception $e) {
            echo $e->getCode();
            return new User();
        }
    }


}
