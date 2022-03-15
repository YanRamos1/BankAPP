<?php

namespace Models;

use Includes\Database;

class Account
{
    public $id;
    public $id_user;
    public $balance;
    public $account_status;
    public $account_type;
    public $created_at;
    public $deleted_at;


    public function __construct()
    {
        $this->id = null;
        $this->id_user = null;
        $this->balance = null;
        $this->account_status = null;
        $this->account_type = null;
        $this->created_at = null;
        $this->deleted_at = null;
    }



    public function save(Account $account)
    {
        $db = Database::connect();
        $sql = "INSERT INTO accounts (id_user, balance, account_status, account_type, created_at, deleted_at) VALUES (:id_user, :balance, :account_status, :account_type, :created_at, :deleted_at)";
        $query = $db->prepare($sql);
        $query->bindValue(':id_user', $account->id_user);
        $query->bindValue(':balance', $account->balance);
        $query->bindValue(':account_status', $account->account_status);
        $query->bindValue(':account_type', $account->account_type);
        $query->bindValue(':created_at', $account->created_at);
        $query->bindValue(':deleted_at', $account->deleted_at);
        $query->execute();
    }

    public function getById($id)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM accounts WHERE account_id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }


    public function getByUser($id){
        //get Account from id user
        $db = Database::connect();
        $sql = "SELECT * FROM accounts WHERE id_user = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        $account = $query->fetchAll();
        return $account;

    }

    //add money to account
    public function addMoney($id, $money){
        $transaction = new Transaction();
        $db = Database::connect();
        $sql = "UPDATE accounts SET balance = balance + :money WHERE account_id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':money', $money);
        $query->bindValue(':id', $id);
        $query->execute();
    }

    public function getAll(){
        $db = Database::connect();
        $sql = "SELECT * FROM accounts";
        $query = $db->prepare($sql);
        $query->execute();
        $accounts = $query->fetchAll();
        return $accounts;
    }

    //get all accounts and user info
    public function getAllAccountsWithUsers(){
        $db = Database::connect();
        $sql = "SELECT accounts.account_id, accounts.balance, accounts.account_status, accounts.account_type, accounts.created_at, accounts.deleted_at, users.id_user, users.first_name, users.last_name, users.city, users.password, users.created_at, users.deleted_at FROM accounts INNER JOIN users ON accounts.id_user = users.id_user";
        $query = $db->prepare($sql);
        $query->execute();
        $accounts = $query->fetchAll();
        return $accounts;
    }

    public function RemoveMoney($id, $money){
        $db = Database::connect();
        $sql = "UPDATE accounts SET balance = balance - :money WHERE account_id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':money', $money);
        $query->bindValue(':id', $id);
        $query->execute();
    }

}
