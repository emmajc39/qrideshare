<?php
/**********************************************
*             RideShare Code init             *
* Emma Chen and Ben Dennerley, September 2014 *
* Contains base html codes                    *
**********************************************/

require_once 'base.php';
require_once "ti.php";
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
		<script>$(function(){$("#datepicker, #datepicker2").datepicker();});</script>
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
		<div id="top-bar">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-xs-12">
						<div id="top-search">
							<form action="./search.php" method="GET">
								<input type="text" name="orig" id="orig" placeholder="From" />
								<input type="text" name="dest" id="dest" placeholder="To" />
								<input type="text" name="date" id="datepicker2" placeholder="YYYY/MM/DD"/>
								<input type="submit" name="submit" value="SEARCH" class="btn">
							</form>
						</div>
					</div>
					<div class="col-sm-4">
						<ul>
							<li>
								<div id="log-in-out">
									Home
								</div>
							</li>
							<li>
								<div id="log-in-out">
									Log In
								</div>
							</li>
							<li>
								<div id="manage">
									Manage Posts
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- includes main body content -->
		<?php emptyblock('body') ?>
		
	</body>
</html>
