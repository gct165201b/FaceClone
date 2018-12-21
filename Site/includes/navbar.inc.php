<nav class="navbar fixed-top navbar-dark navigation">
  <a class="navbar-brand" href="index.php">FaceClone</a>


  <!-- Nav Items will only be displayed if the user is logged in -->

	<ul class="nav justify-content-end">
        <?php if(isset($_SESSION['u_id'])) { ?>
		<li class="nav-item">
			<a class="nav-link active txt-light" href="home.php">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link txt-light" href="profile.php?profile=<?php echo $_SESSION['u_id']; ?>">Profile</a>
		</li>


    		<li class="nav-item">
    			<form action="./includes/processes/logout.inc.php" method="post">
                    <button type="submit" class="btn btn-outline-warning" name="logout">Logout</button>
                </form>
    		</li>

        <?php } ?>

	</ul>
</nav>
