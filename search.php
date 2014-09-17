<?php
require 'init2.php';
$origin = $_GET['orig'];
$destination = $_GET['dest'];
$date = $_GET['date'];
$results = search($origin, $destination, $date);
?>
<?php startblock('body') ?>
<div class="container-fluid" id="recent">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<?php if (count(search($origin, $destination, $date)) > 0 && NULL != search($origin, $destination, $date) )  : ?>
				<?php for($i=0 ; $i < count($results = search($origin, $destination, $date)) ; $i++ ) : ?>
					<div class="col-sm-6 col-md-4 col-lg-3 single-post">

						<div class="row" class="main-info">
							<div class="col-xs-12 block1">
								<?php echo 'From: '. $results[$i]->origin ; ?>
							</div>
						
							<div class="col-xs-12 block2">
								<?php echo 'To: ' . $results[$i]->destination ; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 more-info">
								<div class="col-xs-12 time-info">
									<p><span>Ride Date: </span></p>
									<?php echo $results[$i]->ridedate ; ?>
									<br/>
									<p><span>Ride Time: </span></p>
									<?php echo $results[$i]->ridetime ; ?>
									<br/>
								</div>
								<!-- profile picture
								<div class="col-xs-6">
									<div class="profile-photo">
										<img src=<?php echo 'https://graph.facebook.com/'.$recent[$i]->owner.'/picture?height=70&width=70' ; ?> />
									</div>
								</div>
								-->

							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 more-info">
								<p><span>Description: </span></p>
								<?php echo $results[$i]->description ; ?>
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