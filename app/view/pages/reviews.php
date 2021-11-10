<div class="pageContent">

	<?php require APPROOT . '/view/includes/header.php';?>

	<!-- jumbotron - demonstration bootstrap class -->
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1>Reviews:</h1>

			<!-- create comment table --> 
			<table class="reviewsTable">
				<thead>
					<tr>
						<td>Name</td>
						<td>Review</td>
						<td>Date</td>
					</tr>
				</thead>

				<tbody id="tableBody">
					<?php foreach ($data['reviews'] as $value): ?>
						<tr>
							<td><?php echo $value['user_name']?></td>
							<td><?php echo $value['review']?></td>
							<td><?php echo $value['date']?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		
			<!-- check if loggedin -->
			<?php if (isset($_SESSION['user'])) :?>
				<!-- reviews form --> 
				<form method="post">
					<div class="form-group">
						<!-- shows for logged-in user -->
						<!-- textarea is resizeable review form-->
						<textarea id="review" name="review" class="form-control <?php echo (!empty($data['reviewErr'])) ? 'is-invalid' : ''; ?>" placeholder="Please leave a review!"></textarea> 
						<span class='invalid-feedback'><?php echo $data['reviewErr'] ?></span>
					</div>

					<button type="submit" onclick="submitForm(event)" class="btn btn-primary">Submit</button>
				</form>
			<?php else: ?>
				<a href="<?php echo URLROOT ?>/register">Want to leave a review? Please register!</a>	
			<?php endif; ?>
		</div>
	</div>

	<!-- //////////////////////////////////////////////////////////// -->
	<!-- add review without refresh -->
	<!-- JS -->
	<script>
		function submitForm(event) {
			event.preventDefault();
			let formDataForBackend = {
				review: document.getElementById('review').value,
			};
			fetch(window.location, {
				method:'POST',
				body: JSON.stringify(formDataForBackend),
			}) 
			.then(function (renponse) {
				return renponse.json();
			})
			.then(function ($jsonDataFromBackend) {
				let reviewTextarea = document.getElementById('review');
				if($jsonDataFromBackend.reviewErr){
					 reviewTextarea.className += ' is-invalid';
					let errorSpan = document.getElementsByClassName('invalid-feedback')[0];
					errorSpan.innerHTML = $jsonDataFromBackend.reviewErr;
				} else {
					reviewTextarea.classList.remove('is-invalid');
					let tableBody = document.getElementById('tableBody');
					tableBody.innerHTML += `
					<tr>
					<td>${$jsonDataFromBackend.user_name}</td>
					<td>${$jsonDataFromBackend.review}</td>
					<td>${$jsonDataFromBackend.date}</td>
					</tr>`;
				}
			});
		}
	</script>
</div>

<!-- footer has html & body clossing -->
<?php require APPROOT . '/view/includes/footer.php';?>