<div class="pageContent">
	<?php require APPROOT . '/view/includes/header.php';?>

	<!-- jumbotron - demonstration bootstrap class -->
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1>Register</h1>
			<!-- register form --> 
			<form method="post">
				<div class="form-group">
					<input name="firstname" type="text" class="form-control <?php echo (!empty($data['firstnameErr'])) ? 'is-invalid' : ''; ?>" placeholder="First Name *">
					<span class='invalid-feedback'><?php echo $data['firstnameErr'] ?></span>
				</div>

				<div class="form-group">
					<input name="lastname" type="text" class="form-control <?php echo (!empty($data['lastnameErr'])) ? 'is-invalid' : ''; ?>" placeholder="Last Name *">
					<span class='invalid-feedback'><?php echo $data['lastnameErr'] ?></span>
				</div>

				<div class="form-group">
					<input name="email" type="text" class="form-control <?php echo (!empty($data['emailErr'])) ? 'is-invalid' : ''; ?>" placeholder="Email *">
					<span class='invalid-feedback'><?php echo $data['emailErr'] ?></span>
				</div>

				<div class="form-group">
					<input name="password" type="password" class="form-control <?php echo (!empty($data['passwordErr'])) ? 'is-invalid' : ''; ?>" placeholder="Password *">
					<span class='invalid-feedback'><?php echo $data['passwordErr'] ?></span>
				</div>

				<div class="form-group">
					<input name="phoneNumber" type="text" class="form-control <?php echo (!empty($data['phoneNumberdErr'])) ? 'is-invalid' : ''; ?>" placeholder="Phone Number">
					<span class='invalid-feedback'><?php echo $data['phoneNumberdErr'] ?></span>
				</div>

				<div class="form-group">
					<input name="homeAdress" type="text" class="form-control <?php echo (!empty($data['homeAdressErr'])) ? 'is-invalid' : ''; ?>" placeholder="Home Adress">
					<span class='invalid-feedback'><?php echo $data['homeAdressErr'] ?></span>
				</div>

				<button type="submit" class="btn btn-primary">Register</button>
			</form>
		</div>
	</div>
</div>
	
<!-- footer has html & body clossing -->
<?php require APPROOT . '/view/includes/footer.php';?>