<?php
require '../PhpStuff/vendor/autoload.php';

$cli = new MongoDB\Client("mongodb://localhost");

?>
<html class="h-100">
<head>
<title>Mongo te odio</title>



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="d-flex flex-column h-100 text-center">

<!-- HEADER --!>
<?php include_once 'header.php'; ?>

<!-- HEADER END --!>
	<main role="main" class="flex-shrink-0">
		<div class="container">
		<div class="list-group mt-5">
<?php

foreach($cli->qwerty->Peliculas->aggregate([['$match'=>['genero' => $_GET['cat']]]]) as $num => $row){
	echo '<a href="prod.php?cat='.$_GET['cat'].'&opt='.$row['_id'].'" class="list-group-item list-group-item-action">'.$row['nombre'].'</a>';

}

?>
		</div>
		</div>
	</main>

<!-- FOOTER --!>
<?php include_once 'footer.php'; ?>
<!-- FOOTER END --!>

</body>
</html>
