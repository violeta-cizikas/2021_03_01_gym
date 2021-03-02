<div class="header">
    <nav class="navbar navbar-expand-sm navbar-dark">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="<?php echo URLROOT ?>/">Home</a>           
                <!-- when logedin -->
                <?php if (isset($_SESSION['user'])) :?>                
                    <a class="nav-link" href="<?php echo URLROOT ?>/reviews">Reviews</a>                    
                <?php else: ?>
                <!-- when not logedin -->            
                    <a class="nav-link" href="<?php echo URLROOT ?>/reviews">Reviews</a>                    
                <?php endif; ?>
            </div>
            <!-- bootstrap right side navigation -->
            <div class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user'])) :?>
                    <!-- when logedin -->
                    <a class="nav-link" href="<?php echo URLROOT ?>/logout">Logout</a>
                <?php else: ?>
                    <!-- when not logedin -->
                    <a class="nav-link" href="<?php echo URLROOT ?>/register">Register</a>
                    <a class="nav-link" href="<?php echo URLROOT ?>/login">Login</a>  
                <?php endif; ?>    
            </div>

        </div>
    </nav>
</div>