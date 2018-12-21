<?php
session_start();

if(!isset($_SESSION['u_id'])) {
    header("Location: ./index.php");
    exit();
}
    require 'includes/func.inc.php';
    get_header("My Profile");
    include_once 'includes/navbar.inc.php';
?>





<div class="container-fluid">




	<div class="row mt-12vh p-3">



		<!-- Divide the row into 3 coloumns like 3,6,3 = 12 -->

		<div class="col-lg-3">

			<div class="card p-3">

				<h5>Edit profile</h5>


				<form action="">

					<div class="form-group">
						<input type="text" class="form-control" placeholder="Status">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" placeholder="Location">
					</div>


					<div class="input-group mt-2">
                        <button class="btn login-btn">Save</button>
                    </div>

				</form>

			</div>

		</div>



		<div class="col-lg-6">




		<div class="media">
			<img class="mr-3" id="profile-img" src="imgs/profile.png" alt="Generic placeholder image">
			<div class="media-body">
				<h4 class="mt-0">nicholaskajoh</h4>

				<small>Status: I love to Code!</small>
				<small>Location: Nigeria</small>
			</div>
		</div>



			<hr>

			<div class="card text-center">
				<div class="card-body">

					<p class="card-text text-left">Hello people!This is my first FaceClone post.Hurray!!!</p>

				</div>
				<div class="card-footer">
					<p class="float-left">posted at 2017-05-27 20:45:01 by nicholaskajoh</p>

					<a href="" class="float-right text-danger">[delete]</a>
				</div>
			</div>

		</div>


		<div class="col-lg-3">


			<?php include_once 'includes/myfriends.inc.php'; ?>


		</div>

	</div>



	<small class="float-right pr-4">FaceClone - Made by M.Umar</small>

</div>





<?php

	include_once 'includes/footer.inc.php';

 ?>
