<div class="card mt-4 p-3">
	<p class="font-weight-bold">Friend</p>
	<small>
		<ul>
			<?php
				$profil_id = null;
				if(isset($_GET['user_profile'])) {
					$profil_id = $_GET['user_profile'];
				} else {
					$profil_id = $_SESSION['u_id'];
				}
			 display_friends($profil_id); ?>
		</ul>
	</small>
</div>
