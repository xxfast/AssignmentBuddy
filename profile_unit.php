<div class="profile-container">
	<div class='profile-unit'>
		<?php 
			$username = $_SESSION["username"];	 
		?>
		<p>Welcome,<br><strong>
		<?php
			echo $username;	
		?>
		</strong>
	</div>
	<div class='profile-pic-unit'>
		<?php 
			if($username=="guest")
			{

			}
			else
			{
				echo"<div class='profilepic' style = 'background-image: url(https://avatars3.githubusercontent.com/u/13775137)'></div>";
			}
		?>
		</div>
</div>