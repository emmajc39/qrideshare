<?php
require 'init2.php';
$origin = $_GET['orig'];
$destination = $_GET['dest'];
$date = $_GET['date'];
$type = $_GET['type'];
$results = search($origin, $destination, $date, $type);
?>
<?php startblock('body') ?>
<div class="container-fluid" id="recent">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<?php if (count($results) > 0 && NULL != $results )  : ?>
				<?php for($i=0 ; $i < count($results) ; $i++ ) : ?>
					<div class="col-sm-12 single-post <?php 
					if ($results[$i]->type == 'wanted') {
							echo "wanted";
						} else {
							echo "offering";
						}
					?>">

						<div class="row">
									<div class="col-xs-4 block">
										<?php echo strtoupper($results[$i]->type) ; ?>
									</div>
									<div class="col-xs-4 block">
										<?php echo "FROM: ".$results[$i]->origin; ?>
									</div>
									<div class="col-xs-4 block">
										<?php echo "TO: ".$results[$i]->destination ; ?>
									</div>
								</div>
						<div class="row info">
							<div class="col-sm-3 col-xs-4">
								<div class="profile-photo">
									<img src=<?php echo 'https://graph.facebook.com/'.$results[$i]->owner.'/picture?height=100&width=100' ; ?> />

									<p class="username"><?php $user = getUserByID($results[$i]->owner);
											$username = $user['name'];
											echo $username;
									?></p>
								</div>
									
							</div>
							<div class="col-sm-9 col-xs-8">
								<div class="row">
									<div class="col-xs-12 more-info">
										<div class="col-xs-12 time-info">
											<span><i class="fa fa-calendar"></i> Ride Date: </span>
											<?php echo $results[$i]->ridedate ; ?>
											<br/>
											<span><i class="fa fa-clock-o"></i> Ride Time: </span>
											<?php echo $results[$i]->ridetime ; ?>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xs-12 more-info">
										<p><span>Description: </span></p>
										<?php echo getShortDesc($results[$i]->description) ; ?>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				<?php endfor ; ?>
			<?php else : ?>
				<span>Sorry, no matching posts found :( </span>
			<?php endif ; ?>
		</div>
	</div>
</div>

<?php endblock('body') ?>