<?php
require_once '../base.php';

if (isset($_POST['submit'])) {
	$owner = (isset($_POST['owner']) ? $_POST['owner'] : NULL);
	$orig = (isset($_POST['orig']) ? $_POST['orig'] : NULL);
	$dest = (isset($_POST['dest']) ? $_POST['dest'] : NULL);
	$date = date('Y-m-d', strtotime($_POST['date']));
	$time = ((isset($_POST['time']) && $_POST['time'] != '')  ? $_POST['time'] : "Not Specified");
	$desc = ((isset($_POST['description']) && $_POST['description'] != '')  ? $_POST['description'] : "None");
	$emai = (isset($_POST['email']) ? $_POST['email'] : NULL);
	$phone = ((isset($_POST['phone']) && $_POST['phone'] != '')  ? $_POST['phone'] : "None");
	$type = $_POST['type'];

	foreach (array($orig,$dest,$date,$time,$type) as $var) {
		$var = encode($var);
	}

	$post = new Post($owner, $date, $time, $orig, $dest, $desc, $emai, $phone, $type);
	if (!isset($post)) {
		echo "error";
	}
}
?>