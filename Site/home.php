<?php
session_start();

if(!isset($_SESSION['u_id'])) {
    header("Location: ./index.php");
    exit();
}

    require 'includes/func.inc.php';
    get_header("Home");
    include_once 'includes/navbar.inc.php';
?>



<!-- This page will be displayed if the user is logged in. -->


<!-- Create a row  -->


<div class="container-fluid">


	<div class="row mt-12vh p-3">


		<!-- Divide the row into 3 coloumns like 3,6,3 -->

		<div class="col-lg-3">

			<div class="card p-3">
				<p class="font-weight-bold"><?php echo $_SESSION['username']; ?></p>
				<small><?php if(isset($_SESSION['status'])) {echo $_SESSION['status'];} ?></small>
			</div>


			<div class="card mt-4 p-3">
				<p class="font-weight-bold">Friend Requests</p>
				<small>
					<ul>
                        <?php display_requests($_SESSION['u_id']); ?>
					</ul>
				</small>
			</div>

		</div>



		<div class="col-lg-6">


			<form action="./includes/processes/add_post.inc.php" method="post">

				<div class="input-group">
				  <input type="text" class="form-control" name="post_content" placeholder="Make a post">
				  <div class="input-group-append">
				    <button class="btn btn-success" type="submit" name="add_post">Post</button>
				  </div>
				</div>

			</form>

			<!-- Post Section -->

            <?php display_posts(); ?>


		</div>



		<div class="col-lg-3">
			<div class="card p-3">
				<p class="font-weight-bold">Add Friends</p>
				<small>
					<ul>
						<?php display_users($_SESSION['u_id']); ?>
					</ul>
				</small>
			</div>


			<?php include 'includes/myfriends.inc.php'; ?>
		</div>

	</div>


	<small class="float-right pr-4">FaceClone - Made by M.Umar</small>



</div>



<?php
    include_once 'includes/footer.inc.php';
?>
