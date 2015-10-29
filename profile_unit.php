<div class="profile-container">
	<div class='profile-unit'>
		<?php 
			if (isset($_SESSION["u_firstname"])) $firstName = $_SESSION["u_firstname"];	else $firstName='Guest';
		?>
		<p>Welcome,<br><strong>
		<?php
			echo $firstName;	
		?>
		</strong>
	</div>
	<div class='profile-pic-unit'>
		<?php 
			if($firstName!="Guest")
			{
				//echo"<div class='profilepic' style = 'background-image: url(https://avatars3.githubusercontent.com/u/13775137)'></div>";
			}
		?>
		</div>
</div>