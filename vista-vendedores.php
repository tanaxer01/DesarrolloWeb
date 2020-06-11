<?php
session_start();

require '../PhpStuff/vendor/autoload.php';
$cli = new MongoDB\Client("mongodb://localhost");

function Check($a, $b,$cli)
{
	if(isset($a) && isset($b))
	{
		if($post["register"] == "1"){
			$cli->qwerty->Usuarios->InsertOne(Array("username" => $a, "password" => $b));
		}else{
			$temp = $cli->qwerty->Usuarios->findOne(Array("username" => $a, "password" => $b));
			if($temp){	
				$_SESSION["datos"] = Array($a,$b);
				return True;
			}
		}
	}
}
//se tiene que definir check antes de que se llame al header

if(isset($_SESSION["datos"])){
	$a = $_SESSION["datos"][0];
	$b = $_SESSION["datos"][1];
}else{
	$a = $_POST["user"];
	$b = $_POST["clave"];
}

$check =Check($a, $b,$cli)
?>
<html>
<head>
<title>mongo te odio</title>



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class='text-center'>
<?php include_once "header.php" ?>
<?php
if(isset($_SESSION["datos"])){
	$a = $_SESSION["datos"][0];
	$b = $_SESSION["datos"][1];
}else{
	$a = $_POST["user"];
	$b = $_POST["clave"];
}


if($check)
{
echo <<<EOD
<div class="container my-5">
	<h1>Vista super secreta de vendedores</h1>
		<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Monto total</th>
				<th scope="col">Productos</th>
				<th scope="col">cantidad</th>
			</tr>
		</thead>
		<tbody>
EOD;
$curr = 1;
foreach($cli->qwerty->Ordenes->find() as $num => $info)
{
	echo '<tr><td clospan="4">venta '.$curr.'</td></tr>';
	$f = True;

	foreach($info["productos"] as $id => $cant){
		$temp = $cli->qwerty->Peliculas->findOne(Array("_id" => $id));
		if($f){	
			echo <<<EOD
			<tr>
				<th scope-'col'></th>
				<td>$ {$info["total"]}</td>
				<td>{$temp["nombre"]}
				<td>{$cant}</td>
			</tr>
EOD;
			$f = False;
		}else{
			echo <<<EOD
			<tr>
				<th scope-'col'></th>
				<td></td>
				<td>{$temp["nombre"]}</td>
				<td>{$cant}</td>
			</tr>
EOD;
		}
	}
	echo '<tr><td class="bg-dark" colspan="4"></td></tr>';
$curr++;
}
echo '
</tbody>
</table>
</div>';
}else{
echo <<<EOD
	<form class="form-signin w-25" style="margin-left:38vw; margin-top:20vh" method="post">
		<h1 class="h3 mb-3 font-weight-normal">Login for Vendedores </h1>
		<input type="text" name="user" placeholder="Usuario" class="form-control" required autofocus> 
		<input type="password" name="clave" placeholder="Clave" class="form-control" required>
	
		<div class="checkbox my-3">
		<label><input type="checkbox" name="register" value="1">Register?</input></label>
		</div>
		<button class="btn btn-lg btn-primary btn-lock mt-2" type="submit"> Log in </button>
	</form>
EOD;
}
?>
<?php include_once "footer.php" ?>
</body>
</html>
