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
		$DBH = new PDO("mysql:host=localhost;dbname=rideshare", "root", "");
		return $DBH;
	}
	catch(PDOException $e){
		echo $e->getMessage();
		return false;
	}
}
function search($origin, $destination, $date, $type){
	if (!isset($origin) || $origin == "" ) {
		$origin = '%';
	}
	if (!isset($destination) || $destination == "" ) {
		$destination = '%';
	}
	$origin = strtolower($origin);
	$destination = strtolower($destination);
	
	if (isset($date) && $date != "") {
		$date = date('Y-m-d', strtotime($date));
	} else {
		$date = '%';
	}
	
	$DBH = getConn();

	if ($type == 'all') {
		$SMT = $DBH->query("SELECT * FROM posts WHERE origin LIKE '$origin' AND destination LIKE '$destination' AND ridedate LIKE '$date'");
	}
	else {
		$SMT = $DBH->query("SELECT * FROM posts WHERE origin LIKE '$origin' AND destination LIKE '$destination' AND ridedate LIKE '$date' AND type LIKE '$type'");
	}
	//$SMT->bindValue(":origin", $origin);
	//$SMT->bindValue(":destination", $destination);
	//$SMT->bindValue(":date", $date);
	$results=array();
	if($SMT->execute()){
		$results = $SMT->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Post");
	}
	if(count($results)==0){
		return false;
	}
	return $results;
}

function getRecent() {
	$DBH = getConn();
    $SMT = $DBH->query("SELECT * FROM posts ORDER BY dateadded DESC LIMIT 40");
    $results=array();
    if($SMT->execute()){
	$results = $SMT->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Post");
	}
	if(count($results)==0){
		return false;
    }
    return $results;
}

function getShortDesc($data) {
	if (strlen($data) > 80 ){
		$data = substr($data, 0, 80);
		return $data . '...';
	} else {
		return $data ;
	}
	
}

function encode($data) {
	$data = htmlspecialchars($data, ENT_QUOTES);
	return $data;
}

function decode($data)
{
	$data = preg_replace('/(?:(?:\r\n|\r|\n)\s*){2}/s', '<br/>', $data);
	return $data;
} 

function getUserByID ($id) {
	$DBH = getConn();
    $SMT = $DBH->query("SELECT * FROM users WHERE id = $id ");
    if($SMT->execute()){
    	$result = $SMT->fetchAll();
    }
    return $result[0];
}


?>