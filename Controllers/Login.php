<?php
require_once '../vendor/autoload.php';
use Models\User;


$id = $_POST['id_user'];
$password = $_POST['pass'];

//get user and compare password
$user = User::getById($id);

//if user exists and password is correct
if ($user && $user->password == $password) {
    echo 'true';
} else {
    echo 'false';
    
}
