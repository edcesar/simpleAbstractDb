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

$cliente->nome = 'fabiana';
$cliente->email = 'fabiana@gmail.com';
$cliente->cidade = "Rio";
$cliente->estado = "RJ";

 $cliente->save();

$cliente->update(50);

foreach ($cliente->columns as $key => $value) {
	print $value  . PHP_EOL;
}

print PHP_EOL . PHP_EOL;

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