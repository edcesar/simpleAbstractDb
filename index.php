<?php

use SimpleAbstractPdo\DB;
use src\Models\Cliente;

require_once 'vendor/autoload.php';


try {
	$conexao = new \PDO("mysql:host=localhost;dbname=pdo", "root", "elite7");	
} 
catch (PDOException $e) {
	print 'Ocorreu um erro: ' . $e->getMessage();	
	return;
}


$cliente = new Cliente();

$cliente->nome = 'Joice';
$cliente->email = 'joice@gmail.com';
$cliente->cidade = "Minas Gerais";
$cliente->estado = "MG";

// $cliente->save();

$cliente->update(44);

foreach ($cliente->columns as $key => $value) {
//	print $value  . PHP_EOL;
}

print PHP_EOL . PHP_EOL;


//print_r($cliente->find(63));

print PHP_EOL . PHP_EOL;

print_r($cliente->findOneBy(['nome' => 'joice']));

//print $cliente->getColumnsPdo();

//$cliente->delete(47);



exit;
/*
 $cliente->update();

 $cliente->delete(12);

 print $cliente->find(11)['nome'];

 print PHP_EOL . PHP_EOL . PHP_EOL;


 foreach ($cliente->list() as $c) {
 	echo $c['nome'] . PHP_EOL;
 }


*/