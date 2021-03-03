<div class="header">
	<nav class="navbar navbar-expand-sm navbar-dark">

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-link <?php echo $data['page'] == 'home'? 'active': ''?>" href="<?php echo URLROOT ?>/index">Home</a>           
				<!-- when logged-in -->
				<?php if (isset($_SESSION['user'])) :?>                
					<a class="nav-link <?php echo $data['page'] == 'feedback'? 'active': ''?>" href="<?php echo URLROOT ?>/feedback">Reviews</a>
				<?php else: ?>
				<!-- when not logged-in -->            
					<a class="nav-link <?php echo $data['page'] == 'feedback'? 'active': ''?>" href="<?php echo URLROOT ?>/feedback">Reviews</a>
				<?php endif; ?>
			</div>
			
			<!-- bootstrap right side navigation -->
			<div class="navbar-nav ml-auto">
				<!-- check if logged-in -->
				<?php if (isset($_SESSION['user'])) :?>
					<!-- when logged-in -->
					<a class="nav-link <?php echo $data['page'] == 'logout'? 'active': ''?>" href="<?php echo URLROOT ?>/logout">Logout</a>
				<?php else: ?>
					<!-- when not logged-in -->
					<a class="nav-link <?php echo $data['page'] == 'register'? 'active': ''?>" href="<?php echo URLROOT ?>/register">Register</a>
					<a class="nav-link <?php echo $data['page'] == 'login'? 'active': ''?>" href="<?php echo URLROOT ?>/login">Login</a>  
				<?php endif; ?>    
			</div>

		</div>
	</nav>
</div>