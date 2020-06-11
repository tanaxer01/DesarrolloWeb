<?php
session_start();
require '../PhpStuff/vendor/autoload.php';

$cli = new MongoDB\Client("mongodb://localhost");
?>
<html class="h-100">
<head>
<title>mongo te odio</title>



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class='d-flex flex-column h-100 text-center'>
<!-- HEADER --!>
<?php

if(isset($_GET['out'])){
	unset($_SESSION['datos']);
}

include_once 'header.php'; 
?>
<!-- HEADER END --!>

	<main role="main" class="flex-shrink-0">		
		<div class="container w-50">
			<h1 class="my-5"> PAGINA WEPPP </h1>

			<p class="lead">Log de la entrega:   <a href="https://github.com/tanaxer01/DesarrolloWeb">(github)</a></p> 
<!-- ADDING DATA --!>
<!-- lo deje por para ver si funciona la conn a la bse de datos --!>
			<form action="index.php" method="get">
			<div class="input-group mb-3">
  				<input name="choosen" type="text" class="form-control" placeholder="Busca una pelicula que quieras agregar" aria-label="Recipient's username" aria-describedby="button-addon2">
  				<div class="input-group-append">
    					<button class="btn btn-outline-secondary" type="submit">search</button>
 				</div>
			</div>			
			</form>
<?php

//_id de la 1ra pelicula de la lista 
function getId($name){
	$list = file_get_contents('https://www.imdb.com/find?q='.str_replace(' ','%20',$name).'&s=tt&ref_=fn_al_tt_mr');

	preg_match_all('/<tr class="findResult [a-z]{3,4}">(.*)<\/tr>/U',$list,$matches);

	echo '<div class="alert alert-warning" role="alert">'.str_replace('href="','href="index.php?choosen=|',$matches[0][0]).'</div>';
}

//si no hay col la crea e inserta si no esta en col existente
function addItem($id, $cli){	
	$info = file_get_contents('https://www.imdb.com/'.$id);
	
	//titulo
	preg_match_all('/h1 class="">(.*)&/',$info,$titulo); 
	//foto	
	preg_match_all('/title="'.$titulo[1][0].' Poster"\n\w*src="(.*)"/U',$info,$foto);
	//decription
	preg_match_all('/<div class="inline canwrap">\n.*<p>\n.*<span>(.*)<\/span>/U',$info,$descrip);
	//"price"
	preg_match_all('/"ratingCount": ([0-9]*),/U',$info,$precio);
	//genero
	preg_match_all('/Genres:<\/h4>\n<a href=".*"\n>(.*)</U',$info,$genero);

	if(!$cli->qwerty->Peliculas->findOne(Array("_id" => $id))){

		$datos = Array("_id" => $id,
			       "nombre" => $titulo[1][0],
		       	       "descrip" => $descrip[1][0],
		               "foto" => $foto[1][0],
		       	       "precio" => $precio[1][0],
		       	       "genero" => $genero[1][0]);
		$cli->qwerty->Peliculas->insertOne($datos);
	}	
}


if(isset($_GET['choosen'])){ 
	if($_GET['choosen'][0] != '|'){
		getId($_GET['choosen']);
	}else{
		addItem(substr($_GET['choosen'], 1), $cli);
	}

}

?>
<!-- ADDING DATA END --!>

<!-- CATEGORY LIST --!>
		<div class="list-group border border-dark rounded">
<?php
foreach($cli->qwerty->Peliculas->aggregate([['$group' => ['_id' => '$genero']]]) as $num => $cat){
	if($num%2 == 0){	
	echo '<a href="cat.php?cat='.$cat['_id'].'" class="list-group-item list-group-item-action list-group-item-light">'.$cat['_id'].'</a>';
	}else{	
	echo '<a href="cat.php?cat='.$cat['_id'].'" class="list-group-item list-group-item-action list-group-item-dark">'.$cat['_id'].'</a>';
	}	
}

?>
		</div>

<!-- CATEGORY LIST END --!>
		</div>
	</main>
<!-- FOOTER  --!>
<?php include_once 'footer.php'; ?>
<!-- FOOTER  END--!>
</body>
</html>
