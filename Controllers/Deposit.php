<?php
require_once '../vendor/autoload.php';
use Models\Account;
use Models\Transaction;

$account = new Account();
$a = $account->getById($_POST['id_account']);
$value = $_POST['value'];
$transaction = new Transaction();
$transaction->save('deposit', null,$_POST['id_account'] , $value);
$account->addMoney($_POST['id_account'], $value);
echo "Deposito de R$ ".$value." realizado com sucesso!";
