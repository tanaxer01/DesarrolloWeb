<?php
session_start();

if($_POST['cantidad'] < 1){die("Estupido flanders");}

if(!isset($_SESSION["cart"])){
	$_SESSION["cart"] = Array();
}

if(!isset($_SESSION["cart"][$_POST["product"]])){
	$_SESSION["cart"][$_POST["product"]] = (int)$_POST["cantidad"];
}else{
	$_SESSION["cart"][$_POST["product"]] += $_POST["cantidad"];
}

header("Location: /carrito.php");
?>
