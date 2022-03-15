<?php

namespace Models;

use Includes\Database;

class Transaction
{
    public $transaction_id;
    public $transaction_type;
    public $from_account_id;
    public $to_account_id;
    public $date_issued;
    public $amount;
    public $created_at;
    public $deleted_at;

    public function __construct()
    {
        $this->transaction_id = null;
        $this->transaction_type = null;
        $this->from_account_id = null;
        $this->to_account_id = null;
        $this->date_issued = null;
        $this->amount = null;
        $this->created_at = null;
        $this->deleted_at = null;
    }

    public function save($transaction_type, $from_account_id, $to_account_id, $amount)
    {

        $db = new Database();
        $db = $db->connect();
        $sql = 'INSERT INTO transactions (transaction_type, from_account_id, to_account_id, amount) VALUES (:transaction_type, :from_account_id, :to_account_id, :amount)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':transaction_type', $transaction_type);
        $stmt->bindParam(':from_account_id', $from_account_id);
        $stmt->bindParam(':to_account_id', $to_account_id);
        $stmt->bindParam(':amount', $amount);
        $stmt->execute();
        $db = null;
    }

    //get all transactions and accounts
    public function getTransactionFromAccount($id_account)
    {
        $db = new Database();
        $db = $db->connect();
        $sql = 'SELECT * FROM transactions WHERE from_account_id OR to_account_id = :id_account';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_account', $id_account);
        $stmt->execute();
        $transactions = $stmt->fetchAll();
        $db = null;
        return $transactions;
    }


}
