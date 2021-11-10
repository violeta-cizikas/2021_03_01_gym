<div class="pageContent">
	<?php require APPROOT . '/view/includes/header.php';?>

	<!-- jumbotron - demonstration bootstrap class -->
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1>Login</h1>

			<!-- login form --> 
			<form method="post">
				<div class="form-group">
					<input name="email" type="text" class="form-control <?php echo (!empty($data['emailErr'])) ? 'is-invalid' : ''; ?>" placeholder="Email">
					<span class='invalid-feedback'><?php echo $data['emailErr'] ?></span>
				</div>

				<div class="form-group">
					<input name="password" type="password" class="form-control <?php echo (!empty($data['passwordErr'])) ? 'is-invalid' : ''; ?>" placeholder="Password">
					<span class='invalid-feedback'><?php echo $data['passwordErr'] ?></span>
				</div>

				<button type="submit" class="btn btn-primary">Login</button>
			</form>		
		</div>
	</div>
</div>

<!-- footer has html & body clossing -->
<?php require APPROOT . '/view/includes/footer.php';?>