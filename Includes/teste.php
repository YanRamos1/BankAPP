<?php
require_once '../vendor/autoload.php';
use Includes\Database;


$db = new PDO('mysql:host=localhost;dbname=bd_bank', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Conexão realizada com sucesso!";
