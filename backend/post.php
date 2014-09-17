<?php
/**********************************************
*             RideShare Post Class            *
* Emma Chen and Ben Dennerley, September 2014 *
*       Contains class to handle posts        *
**********************************************/
class Post
{

	public $owner;
	public $ridedate;
	public $ridetime;
	public $origin;
	public $destination;
	public $description;
	public $email;
	public $message;
	
	function __construct($owner=NULL, $ridedate=NULL, $ridetime=NULL, $origin=NULL, $destination=NULL, $description=NULL, $email=NULL, $phone=NULL){
		$this->owner = $owner;
		$this->ridedate = $ridedate;
		$this->origin = $origin;
		$this->destination = $destination;
		$this->description = $description;
		$this->email = $email;
		$this->phone = $phone;
		$DBH = getConn();
		$SMT = $DBH->prepare("INSERT INTO posts (owner, ridedate, ridetime, origin, destination, description, email, phone) VALUES (:owner, :ridedate, :ridetime, :origin, :destination, :description, :email, :phone)");
		$SMT->bindParam(':owner', $owner);
		$SMT->bindParam(':ridedate', $ridedate);
		$SMT->bindParam(':ridetime', $ridetime);
		$SMT->bindParam(':origin', $origin);
		$SMT->bindParam(':destination', $destination);
		$SMT->bindParam(':description', $description);
		$SMT->bindParam(':email', $email);
		$SMT->bindParam(':phone', $phone);
		$SMT->execute();
		$DBH = null;
	}
}
function getPostObject($id){ //get post object from database by ID
	$DBH = getConn();
	$SMT = $DBH->query("SELECT * FROM posts WHERE id=$id");
	return $SMT->fetch(PDO::FETCH_OBJ);
	
}
?>