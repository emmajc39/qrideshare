<?php require_once 'init2.php' ; ?>

<!-- add new post -->

<?php startblock('body') ; ?>

<div class="container-fluid" id="addnew">
	<div class="row" id="new-post">
		<div class="col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1" id="addnewform">
			<h2>Add A New Post</h2>
			<form action="action/add.php" method="POST" ?>
				<div class="row">
					<div class="col-xs-8">
						<label>Post Type:</label>
						<select type="text" name="type" class="form-control" required>
							<option value="offering">Offering</option>
							<option value="wanted">Wanted</option>
						</select>

						<label>Departure Location:</label>
						<input type="text" name="orig" id="orig" class="form-control" required />

						<label>Destination</label>
						<input type="text" name="dest" id="dest" class="form-control" required />


						<label>Date:</label>
						<input type="text" name="date" id="datepicker" class="form-control" required />

						<label>Time (optional):</label>
						<input type="text" name="time" class="form-control" />

						<label>Contact E-mail:</label>
						<p> (choose to use the e-mail address associated with you Facebook account or enter a separate email)</p>
						<div class="row">
							<div class="col-xs-12" id="custom-email">
								<input type="email" class="form-control" name="email" id="email" required />
							</div>
						</div>
						
						<label>Phone Number (optional):</label>
						<input type="text" name="phone" class="form-control" />
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<label>Description</label>
						<textarea rows="8" placeholder="Enter a short description or any other comments" class="form-control" name="description"></textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<input type="hidden" name="owner" class="form-control" id="post-owner" />
						<input type="submit" name="submit" value="submit" class="form-control" />
				 	</div>
			 	</div>
		 	</form>
	 	</div>
 	</div>
 </div>

 <?php endblock('body') ?>