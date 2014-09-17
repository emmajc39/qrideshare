<?php
/**********************************************
*            RideShare User Class             *
* Emma Chen and Ben Dennerley, September 2014 *
*        Contains class to handle users       *
**********************************************/
class User
{
	function __construct($id=NULL, $email=NULL, $fname=NULL, $lname=NULL, $fbtoken=NULL){
		$this->id = $id;
		$this->email = $email;
		$this->fname = $fname;
		$this->lname = $lname;
		$this->fbtoken = $fbtoken;
		$DBH = getConn();
		$SMT = $DBH->prepare("INSERT INTO users (id, email, fname, lname, fbtoken) VALUES (:id, :email, :fname, :lname, :fbtoken)");
		$SMT->bindParam(':id', $id);
		$SMT->bindParam(':email', $email);
		$SMT->bindParam(':fname', $fname);
		$SMT->bindParam(':lname', $lname);
		$SMT->bindParam(':fbtoken', $fbtoken);
		$SMT->execute();
	}
}
function getUserObject($id){ //get user object from database by ID
		$DBH = getConn();
		$SMT = $DBH->query("SELECT * FROM users WHERE id=$id");
		return $SMT->fetch(PDO::FETCH_OBJ);
}
?>