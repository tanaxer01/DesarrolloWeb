<?php
session_start();
require '../PhpStuff/vendor/autoload.php';

$cli = new MongoDB\Client("mongodb://localhost");

$old = $cli->qwerty->Ordenes;
$new = $cli->qwerty->ordenes;

foreach($old->find() as $i){
	foreach($i["productos"] as $j => $info){
		$id = $cli->qwerty->peliculas->findOne(["link" => $j]);
		var_dump((string)$id["_id"]);

		$old->find(
			[ "_id" => $i['_id']]
		);
	}	
}
/*
foreach($cli->qwerty->peliculas->find() as $i){
	echo "<div>";
	echo $i["nombre"];
	$id = (string)$i["genero"];

	echo gettype($i["genero"]);

	$db->updateOne(
		[ 'nombre' => $i["nombre"]],
		[ '$set' => [ 'genero' => $id ]]
	);
	
	echo gettype($i["genero"]);
	echo "</div>";
}
 */

?>
