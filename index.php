<?php require_once 'init.php' ; ?>

<!-- index page -->

<?php startblock('body');?>
<div class="container-fluid" id="head">
	<div id="top-banner">
		<span></span>
	</div>
	<div id="status"></div>
	<div id="fb-login">
		<div class="fb-login-button btn" scope="public_profile,email" perms="user_mobile_phone" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true" onlogin="checkLoginState();"></div>
	</div>
	<form class="ui-widget" id="search" action="search.php" method="GET">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-xs-4 col-sm-offset-2">
					<input type="text" name="orig" id="orig" class="form-control" placeholder="Departure Location" />
				</div>
				<div class="col-sm-3 col-xs-4">
					<input typle="text" name="dest" id="dest" class="form-control" placeholder="Destination"/>
				</div>
				<div class="col-sm-2 col-xs-4">
					<input type="text" name="date" class="form-control" id="datepicker" placeholder="Date of Trip"></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12" style="text-align:center;">
					<span>You may leave a field blank if you are not sure.</span>
				</div>
			</div>
			<div id="search-btn">
					<input type="submit" name="submit" value="SEARCH"  class="form-control" />
			</div>
		</div>

	</form>
</div>
<div class="container-fluid" id="recent">
	<div class="row">
		<div class="col-sm-10  col-sm-offset-1">
			<h2>Recent Posts</h2>
			<?php if (count(getRecent()) > 0) : ?>
				<?php for($i=0 ; $i < count($recent = getRecent()) ; $i++ ) : ?>
					<div class="col-sm-6 col-md-4 col-lg-3 single-post">

						<div class="row" class="main-info">
							<div class="col-xs-4 block3">
								FROM: 
							</div>
							<div class="col-xs-8 block1">
								<?php echo $recent[$i]->origin ; ?>
							</div>
							<div class="col-xs-4 block4">
								TO:
							</div>
							<div class="col-xs-8 block2">
								
								<?php echo $recent[$i]->destination ; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 more-info">
								<div class="col-xs-12 time-info">
									<p><span><i class="fa fa-calendar"></i> Ride Date: </span></p>
									<?php echo $recent[$i]->ridedate ; ?>
									<br/>
									<p><span><i class="fa fa-clock-o"></i> Ride Time: </span></p>
									<?php echo $recent[$i]->ridetime ; ?>
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
								<?php echo getShortDesc($recent[$i]->description) ; ?>
							</div>
						</div>
						
					</div>
				<?php endfor ; ?>
			<?php else : ?>
				<span>No Posts Available Yet </span>
			<?php endif ; ?>
				
		</div>
	</div>
</div>

<?php endblock('body') ; ?>