<?php
require_once '../vendor/autoload.php';
use Models\User;
//add user to database
$user = new User();

$user->first_name = $_POST['first_name'];
$user->last_name = $_POST['last_name'];
$user->password = $_POST['password_register'];
$user->city = $_POST['city'];
$user->created_at = date('Y-m-d H:i:s');
$user->save($user);
?>


