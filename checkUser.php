<?php

require_once 'base.php';

$userID = (isset($_POST['id']) ? $_POST['id'] : NULL);
$userEmail = (isset($_POST['email']) ? $_POST['email'] : NULL);
$userName = (isset($_POST['name']) ? $_POST['name'] : NULL);
$userPhone = (isset($_POST['phone']) ? $_POST['phone'] : NULL);

$DBH = getConn();
$SMT = $DBH->query("SELECT * FROM users WHERE id = '$userID'");
//$SMT->bindValue(":origin", $origin);
//$SMT->bindValue(":destination", $destination);
//$SMT->bindValue(":date", $date);
$results=array();
if($SMT){
	$results = $SMT->fetchAll();
	if (count($results)==0){
	$SMT = $DBH->query("INSERT INTO users (id, name, email) VALUES ('$userID', '$userName', '$userEmail')");
	} else {
		return true;
	}
}
?>