<?php
/**********************************************
*             RideShare Code init             *
* Emma Chen and Ben Dennerley, September 2014 *
* Contains base html codes                    *
**********************************************/

require_once 'base.php';
require_once "ti.php";
require_once "facebook-php-sdk/autoload.php";

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

FacebookSession::setDefaultApplication('299786516892944', 'a5f47d859feab6b62a7cfd29f029fe57');
?>

<!DOCTYPE html>
<!-- Emma Chen&Ben Dennerley Queen'sRideShare 2014-->
<html>

	<head>
		<title>Queen's Ride Share</title>
		<link href='http://fonts.googleapis.com/css?family=Roboto:900,300,100,700,500,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="style/font-awesome/css/font-awesome.css"/>
		<link rel="stylesheet" type="text/css" href="style/css/main.css"/>
		<link rel="stylesheet" href="style/jquery-ui/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	</head>


	<body>
		<!--script for datepicker -->
		<script>$(function(){$("#datepicker").datepicker();});</script>
		<!--/script for datepicker -->

		<!-- script for autocomplete -->
		<script>
		$(function(){
			var availableTags=["Toronto",
			"Kingston",
			"London",
			"Windsor",
			"Guelph",
			"Ottawa",
			"Montreal",
			"Quebec",
			"Mississauga",
			"Hamilton",
			"Waterloo",
			"Kitchener",
			"Markham",
			"Niagara Falls",
			"North Bay",
			"Brampton",
			"Pickering",
			"Ajax",
			"Sarnia",
			"Oshawa",
			"St. Catharines",
			"Vaughan",
			];
			$("#orig, #dest").autocomplete({source:availableTags});
		});
		</script>
		<!-- /script for autocomplete -->
		<!-- script for fb login -->
		<script type="text/javascript" src="js/fblogin.js"></script>
		<!-- /script for fb login -->

		<!-- include a header that shows up on every page except for the main page -->
		<?php emptyblock('head') ?>

		<!-- includes main body content -->
		<?php emptyblock('body') ?>
		
	</body>
</html>
