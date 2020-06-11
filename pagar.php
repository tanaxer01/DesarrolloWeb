<?php
session_start();

require '../PhpStuff/vendor/autoload.php';
$cli = new MongoDB\Client("mongodb://localhost");


$cli->qwerty->Ordenes->InsertOne(Array('total' => $_POST['total'], 'productos' => $_SESSION['cart']));
unset($_SESSION["cart"]);
?>
<html class="h-100">
<head>
<title>mongo te odio</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class='d-flex flex-column h-100 text-center'>
<?php include_once("header.php"); ?>

	<div class="jumbotron">
		<h2 class="display-4">Compra procesada correctamete!</h2>	
		<p class="lead">gg wp</p>
		<hr />
		<a class="btn btn-primary btn-lg" href="index.php">pal lobby</a>
	</div>
<?php include_once("footer.php"); ?>
</body>
</html>
