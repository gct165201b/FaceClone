<?php
    require 'includes/func.inc.php';
    pageHeader("Home");
    include_once 'includes/navbar.inc.php';
?>



<!-- This page will be displayed if the user is logged in. -->


<!-- Create a row  -->


<div class="container-fluid">
	

	<div class="row mt-12vh p-3">
		

		<!-- Divide the row into 3 coloumns like 3,6,3 -->
		
		<div class="col-lg-3">
			
			<div class="card p-3">
				<p class="font-weight-bold">nicholaskajoh</p>
				<small>I love to code!</small>
			</div>


			<div class="card mt-4 p-3">
				<p class="font-weight-bold">Friend Requests</p>
				<small>
					<ul>
						<li>
							<!-- Link to profile of the person. -->
							<a href="">johndoe</a> 
							<!-- Link to accept the friend request. -->
							<a href="" class="text-success">[accept]</a>
							<!-- Link to Reject the request -->
							<a href="" class="text-danger">[decline]</a>
						</li>
					</ul>
				</small>
			</div>

		</div>



		<div class="col-lg-6">
			

			<form action="">
				
				<div class="input-group">
				  <input type="text" class="form-control" placeholder="Make a post">
				  <div class="input-group-append">
				    <button class="btn btn-success" type="button">Post</button>
				  </div>
				</div>

			</form>




			<!-- Hr -->


			<hr>



			<!-- Post Section -->



			


		</div>



		<div class="col-lg-3">
			<div class="card p-3">
				<p class="font-weight-bold">Add Friends</p>
				<small>
					<ul>
						<li>
							<!-- Link to profile of the person. -->
							<a href="">Alberte</a> 
							<!-- Link to send friend request. -->
							<a href="">[add]</a>
							
						</li>
					</ul>
				</small>
			</div>


			<div class="card mt-4 p-3">
				<p class="font-weight-bold">Friend</p>
				<small>
					<ul>
						<li>
							<!-- Link to profile of the person. -->
							<a href="">Peterpane</a> 
							
							<!-- Link to unfriend a person -->
							<a href="" class="text-danger">[unfriend]</a>
						</li>
					</ul>
				</small>
			</div>
		</div>

	</div>


</div>



<?php
    include_once 'includes/footer.inc.php';
?>
