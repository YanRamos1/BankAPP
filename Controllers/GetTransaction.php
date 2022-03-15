<?php
require_once '../vendor/autoload.php';
use Includes\Database;
use Models\Transaction;

$account_id = $_POST['id_account'];
$transaction = new Transaction();
$transactions = $transaction->getTransactionFromAccount($account_id);
foreach ($transactions as $t){

    echo '<tr>';
    echo '<td>'.$t['transaction_type'].'</td>';
    echo '<td>'.$t['amount'].'</td>';
    echo '<td>'.$t['from_account_id'].'</td>';
    echo '<td>'.$t['to_account_id'].'</td>';

    //echo date('d-m-Y', strtotime($t['date']));
    echo '<td>'.date('d-m-Y', strtotime($t['created_at'])).'</td>';
    echo '</tr>';

}
