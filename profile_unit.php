<div class="profile-container">
	<div class='profile-unit'>
		<?php 
			$firstName = $_SESSION["u_firstname"];	 
		?>
		<p>Welcome,<br><strong>
		<?php
			echo $firstName;	
		?>
		</strong>
	</div>
	<div class='profile-pic-unit'>
		<?php 
			if($username!="guest")
			{
				echo"<div class='profilepic' style = 'background-image: url(https://avatars3.githubusercontent.com/u/13775137)'></div>";
			}
		?>
		</div>
</div>