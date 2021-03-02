<?php require APPROOT . '/view/includes/header.php';?>

<!-- jumbotron - demonstration bootstrap class -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
    	<h1>Reviews</h1>

    	<!-- create comment table --> 
    	<table class="reviewsTable">
    		<thead>
    			<tr>
    				<td>Name</td>
    				<td>Review</td>
    				<td>Date</td>
    			</tr>
    		</thead>

    		<tbody>
    			<tr>
    				<td>petras</td>
    				<td>Comment</td>
    				<td>2021.03.02</td>
    			</tr>
    		</tbody>
    	</table>

		<!-- reviews form --> 
    	<form method="post">
  			<div class="form-group">
  				<!-- shows for logdin user -->
  				<!-- textarea is resizeable review form-->
			    <textarea name="review" class="form-control <?php echo (!empty($data['reviewErr'])) ? 'is-invalid' : ''; ?>" placeholder="Please leave a review!"></textarea> 
          		<span class='invalid-feedback'><?php echo $data['reviewErr'] ?></span>
  			</div>

  			<button type="submit" class="btn btn-primary">Submit</button>
    	</form>
	</div>
</div>

<?php require APPROOT . '/view/includes/footer.php';?>