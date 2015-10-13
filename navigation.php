
<!-- Nav -->
	<nav id="nav">
		<ul class="links">
			<li>
			<?php 
				if(isset ($_SESSION["username"]))
				{
					require 'profile_unit.php';
				}
			?>
			</li>
			<li><a href="index.php"><img class='menuicon' src="images/icons/home.svg" alt="" /> Home</a></li>
			<?php 
				if(isset ($_SESSION["username"]))
				{
					if($_SESSION["username"]!='guest')
					{
						echo "<li><a href='profile.html'><img class='menuicon' src='images/icons/profile.svg' alt='' /> Profile</a></li>";
					}
					else
					{
						echo "<li><a href='login.php'><img class='menuicon' src='images/icons/login.svg' alt='' /> Sign In</a></li>";
					}
					echo "<li><a href='logout.php'><img class='menuicon' src='images/icons/logout.svg' alt='' /> Sign out</a></li>";
				}
				else
				{
					echo "<li><a href='login.php'><img class='menuicon' src='images/icons/login.svg' alt='' /> Sign In</a></li>";
					echo "<li><a href='register_form.php'><img class='menuicon' src='images/icons/register.svg' alt='' /> Sign up</a></li>";
				}
			?>
			
			<li><a href="index.php#two"><img class='menuicon' src="images/icons/info.svg" alt="" /> About Us</a></li>
		</ul>
	</nav>
