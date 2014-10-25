<?php require_once 'init.php' ; ?>

<!-- index page -->

<?php startblock('body');?>

<div id="head">
	<div class="header">
			
		</div>
	<div id="top-banner">
		<span></span>
	</div>
	<div id="status"></div>
	<div id="fb-login">
		<div class="fb-login-button btn" scope="public_profile,email" perms="user_mobile_phone" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true" onlogin="checkLoginState();"></div>
	</div>
	<div class="search">
		<form class="ui-widget" id="search" action="search.php" method="GET">
				<input type="text" name="orig" id="orig" class="form-field form-field1" placeholder="Departure Location" /
				><input typle="text" name="dest" id="dest" class="form-field form-field1" placeholder="Destination"/
				><input type="text" name="date" class="form-field form-field2" id="datepicker" placeholder="Date of Trip"
				><div class="select">
					<select type="text" name="type" class="form-field form-field3 type">
						<option value="all">All</option>
						<option value="offering">Offering</option>
						<option value="wanted">Wanted</option>
					</select></div
				><input type="submit" name="submit" value="SEARCH"  class="form-field form-field3 button" />
				<div style="text-align:center;">
					<span>You may leave a field blank if you are not sure.</span>
				</div>
			</div>
		</form>
	</div>
</div>
				
<div class="categories">
	<h2><center>Hot Destinations</center></h2>
	<ul>
		<li>
			<div class="foo-block" id="toronto">
				<div class="overlay">TORONTO</div>
			</div>

		</li>
		<li>
			<div class="foo-block" id="london">
				<div class="overlay">KINGSTON</div>
			</div>
		</li>
		<li>
			<div class="foo-block" id="waterloo">
				<div class="overlay">WATERLOO</div>
			</div>
		</li>
		<li>
			<div class="foo-block" id="waterloo">
				<div class="overlay">LONDON</div>
			</div>
		</li>
	</ul>
</div>
<div class="container-fluid" id="recent">
	<div class="row">
		<div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
			<h2>Recent Posts</h2>
			<?php if (count(getRecent()) > 0) : ?>
				<?php for($i=0 ; $i < count($recent = getRecent()) ; $i++ ) : ?>
					<div class="col-sm-12 single-post <?php 
					if ($recent[$i]->type == 'wanted') {
							echo "wanted";
						} else {
							echo "offering";
						}
					?>">
						<div class="row">
									<div class="col-xs-4 block">
										<?php echo strtoupper($recent[$i]->type) ; ?>
									</div>
									<div class="col-xs-4 block">
										<?php echo "FROM: ".$recent[$i]->origin; ?>
									</div>
									<div class="col-xs-4 block">
										<?php echo "TO: ".$recent[$i]->destination ; ?>
									</div>
								</div>
						<div class="row info">
							<div class="col-sm-3 col-xs-4">
								<div class="profile-photo">
									<img src=<?php echo 'https://graph.facebook.com/'.$recent[$i]->owner.'/picture?height=100&width=100' ; ?> />

									<p class="username"><?php $user = getUserByID($recent[$i]->owner);
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
											<?php echo $recent[$i]->ridedate ; ?>
											<br/>
											<span><i class="fa fa-clock-o"></i> Ride Time: </span>
											<?php echo $recent[$i]->ridetime ; ?>

										</div>
										

									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 more-info">
										<p><span>Description: </span></p>
										<?php echo getShortDesc($recent[$i]->description) ; ?>
									</div>
								</div>
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