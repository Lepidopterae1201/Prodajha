<?php
function getBdd(){
	try {
	    return new PDO("mysql:host=127.0.0.1;port=3306,dbname=boutique;charset=UTF8", "root", "");
	}
	catch( PDOException $Exception ) {
	    print_r($Exception);
	    return false;
	}
}
?>