<!-- Coneccion a Mongo y pedimos el objeto --!>
<?php
require '../PhpStuff/vendor/autoload.php';

$cli = new MongoDB\Client("mongodb://localhost");

$opt = $_GET['opt'];
$curr = $cli->qwerty->Peliculas->findOne(Array('_id' => $opt));

?>
<!-- Coneccion a Mongo y pedimos el objeto END--!>

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
			<div class="col-5">
				<?php echo '<img src="'.$curr['foto'].'" class="shadow-lg border border-dark rounded" width="350" height="500">'; ?>
				<p>cuidado que la calidad de imagen puede ser demaciado buena</p>
			</div>
			<div class="col-7">
			<div class="jumbotron m-2 border rounded">
				<h3><?php echo $curr['nombre']; ?></h3>
				<p><?php echo $curr['descrip']; ?></p>
				<hr \>
				<p class="text-danger">vale exactamente <?php  echo $curr['precio']; ?> dineros </p>
				<form action="agregar.php" method="post">
				<div class="from-class">
					<label for "cantidad">Cantidad de Unidades : </label>
					<input name="cantidad" id="cantidad" type="number" value="1" min="1">
					<input name="product" type="hidden" value="<?php echo $_GET["opt"] ?>">

					<button id="submit" type="submit" class="btn btn-warning btn-lg btn-block">Purchase Dis</button>
	
				</div>
				</form>	
			</div>
			</div>
		</div>
	</div>



	</main>
<!-- FOOTER  --!>
<?php include_once 'footer.php' ?>
<!-- FOOTER  END --!>
<body>
<html>
