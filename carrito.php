<?php 
session_start(); 

require '../PhpStuff/vendor/autoload.php';
$cli = new MongoDB\Client("mongodb://localhost");

?>
<html class="h-100">
<head>
<title>Mongo te Odio</title>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="d-flex flex-column h-100 text-center">
<!-- HEADER  --!>
<?php include_once 'header.php'; ?>
<!-- HEADER  END --!>
<main role="main" class="flex-shrink-0">
<div class="container mt-5">
	<div class="row">
	<div class="col-8 mr-3 jumbotron border rounded shadow-sm">
		<h2>Carrito de compras </h2>

		<ul class="list-group">
<?php
if(isset($_GET["del"])){unset($_SESSION["cart"][$_GET["del"]]);}

$total = 0;
foreach($_SESSION["cart"] as $id => $cant){
	$temp = $cli->qwerty->peliculas->findOne(Array("_id" => new MongoDB\BSON\ObjectId($id)));
	$total += $cant*$temp["precio"];

	echo <<<EOD
			<li class="list-group-item d-flex justify-content-between align-items-center">
			{$temp["nombre"]}
			<div>
				<span class="text-danger">$ {$temp["precio"]}</span>
				<span class="badge badge-primary badge-pill">{$cant}</span>	
				<a href="carrito.php?del={$id}">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 16" width="12" height="16"><path fill-rule="evenodd" d="M11 2H9c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1H2c-.55 0-1 .45-1 1v1c0 .55.45 1 1 1v9c0 .55.45 1 1 1h7c.55 0 1-.45 1-1V5c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm-1 12H3V5h1v8h1V5h1v8h1V5h1v8h1V5h1v9zm1-10H2V3h9v1z"></path></svg>
				</a>
			</div>
			</li>
EOD;
}
?>
		</ul>
	</div>
	<div class="col-3 jumbotron border rounder shadow-sm">
<?php  echo 'Costo total $'.$total; ?>
		<form action="pagar.php" method="post">
			<input name="total" type="hidden" value=<?php echo '"'.$total.'"';?>>
			<button type="submit" class="btn btn-danger">Paga maldito paga</button>
		</form>
	</div>
	</div>
</div>
</main>
<!-- FOOTER  --!>
<?php include_once 'footer.php' ?>
<!-- FOOTER  END --!>
</html>
