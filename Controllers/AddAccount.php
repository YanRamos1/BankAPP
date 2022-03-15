<?php
require_once '../vendor/autoload.php';

use Models\User;
use Models\Account;

//add user to database
$user = User::getById($_POST['id_user']);

$type = $_POST['type'];
$account = new Account();


//verify if user have one of this type of account
$accounts = $account->getByUser($user->id_user);
$cc = 0;
$cp = 0;
foreach ($accounts as $a) {
    if ($a['account_type'] == 'Conta Corrente') {
        $cc++;
    }
    if ($a['account_type'] == 'Conta Poupança') {
        $cp++;
    }
}
if($_POST['type'] == '1'){
    if($cc == 0){
        $account->account_type = 'Conta Corrente';
        $account->account_status = 'Ativa';
        $account->balance = 0;
        $account->id_user = $user->id_user;
        $account->save($account);
        echo 'Conta Corrente adicionada com sucesso!';
    }else{
        echo 'Você já possui uma conta corrente!';
    }
}
if ($_POST['type'] == '2') {
    if ($cp == 0) {
        $account->account_type = 'Conta Poupança';
        $account->account_status = 'Ativa';
        $account->balance = 0;
        $account->id_user = $user->id_user;
        $account->save($account);
        echo 'Conta Poupança adicionada com sucesso!';
    }else{
        echo 'Usuário já possui uma conta poupança!';
    }
}




?>


