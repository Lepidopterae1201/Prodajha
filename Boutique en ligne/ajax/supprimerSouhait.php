<?php
session_start();
require_once('../modeles/ListeSouhait.php');
$Liste = new ListeSouhait();

if(isset($_POST['idart']) && !empty($_POST['idart'])){
	$idC=$_SESSION['idClient'];
	$idart=$_POST['idart'];
    $resultat = $Liste->suprListeSouhait($idC, $idart);
    if (isset($resultat)) { 
		echo json_encode(["succes"=>true]);
    }else{ 
		echo json_encode(["succes"=>false]);
	}
}else{ 
	echo json_encode(["succes"=>false]);
}
