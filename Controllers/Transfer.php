<?php
require_once '../vendor/autoload.php';

use Models\Transaction;
use Models\User;
use Models\Account;

$account = new Account();

$FromAccount = $_POST['FromAccount'];
$ToAccount = $_POST['ToAccount'];
$value = $_POST['value'];

$f = $account->getById($FromAccount);
$t = $account->getById($ToAccount);



if ($f['balance'] < $value) {
    echo "Not enough money";
} else {
    try {
        $account->RemoveMoney($FromAccount, $value);
        $account->AddMoney($ToAccount, $value);
        $transaction = new Transaction();
        $transaction->save('transfer', $_POST['FromAccount'],$_POST['ToAccount'] , $value);
        echo "Transfer successful";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


