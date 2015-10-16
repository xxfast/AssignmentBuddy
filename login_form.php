<!-- Login -->

	<section id="four" class="wrapper style2 special">
		<div class="inner">
			<header class="major narrow">
				<h2>Sign In</h2>
			</header>
			<form action="login_process.php" method="POST">
				<div class="container 75%">
					<div class="row uniform 50%">
						<div class="6u 12u$(xsmall)">
							<?php 
								$guest = $_GET['guest'];
								if ($guest==true)
								{
									echo "<input name='username' placeholder='Email' type='text' value='guest' />";
								}
								else
								{
									echo "<input name='username' placeholder='Email' type='text'/>";
								}
							
							?>
						</div>
						<div class="6u$ 12u$(xsmall)">
							<input name="password" placeholder="Password" type="password" />
						</div>
					</div>
					<?php 
						if(isset($_GET["error"]))
						{
							echo "<div class='error'> ";
							$error = $_GET['error'];
							echo "<p><img class='erroricon' src='images/icons/error.svg' alt='' /> $error</p>";
							echo "</div>";
						}
					?>
				</div>
				<ul class="actions">

					<li><input type="submit" class="special" value="Login" /></li>
					<li><input type="reset" class="alt" value="Clear" /></li>
				</ul>
			</form>
		</div>
	</section>