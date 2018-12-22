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


				<form action="./includes/processes/update_profile.inc.php" method="post">

					<div class="form-group">
						<input type="text" name="user_status" class="form-control" placeholder="Status">
					</div>

					<div class="form-group">
						<input type="text" name="user_location" class="form-control" placeholder="Location">
					</div>


					<div class="input-group mt-2">
                        <button type="submit" name="update_profile" class="btn login-btn">Save</button>
                    </div>

				</form>

			</div>

		</div>



		<div class="col-lg-6">




		<div class="media">
			<img class="mr-3" id="profile-img" src="imgs/profile.png" alt="Generic placeholder image">
			<div class="media-body">
				<?php show_profile($_GET['profile']); ?>
			</div>
		</div>



			<?php display_posts($_GET['profile']); ?>

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
