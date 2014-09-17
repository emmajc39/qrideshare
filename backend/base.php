<?php
/**********************************************
*             RideShare Code base             *
* Emma Chen and Ben Dennerley, September 2014 *
* Contains MySQL connection info and others   *
**********************************************/
require_once 'backend/user.php';
require_once 'backend/post.php';
function getConn(){//returns PDO connection object. 
	try{
		$DBH = new PDO("mysql:host=localhost;dbname=rideshare", "rideshare_master", "Shtvp4aMSSLysb9B");
		return $DBH;
	}
	catch(PDOException $e){
		echo $e->getMessage();
		return false;
	}
}
function search($origin, $destination, $date){
	$origin = strtolower($origin);
	$destination = strtolower($destination);
	$date = date('Y-m-d', strtotime($date));
	$DBH = getConn();
	$SMT = $DBH->prepare("SELECT * FROM posts WHERE origin=:origin AND destination=:destination AND ridedate=:date");
	$SMT->bindValue(":origin", $origin);
	$SMT->bindValue(":destination", $destination);
	$SMT->bindValue(":date", $date);
	$results=array();
	if($SMT->execute()){
		$results = $SMT->fetchAll(PDO::FETCH_CLASS, "Post");
	}
	if(count($results)==0){
		return false;
	}
	return $results;
}

function getRecent() {
    $SMT = $DBH->prepare("SELECT * FROM posts ORDER BY dateadded DESC LIMIT 20");
    $SMT->bindValue(":origin", $origin);
    $SMT->bindValue(":destination", $destination);
    $SMT->bindValue(":date", $date);
    $results=array();
    if($SMT->execute()){
	$results = $SMT->fetchAll(PDO::FETCH_CLASS, "Post");
	}
	if(count($return)==0){
		return false;
    }
    return $results;
}

function encode($data) {
	
}

?>