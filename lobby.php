<?php 
	session_start();
	if(!isset ($_SESSION["username"]))
	{
		header("location:login.php");
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Lobby</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
		<?php require ("header.php"); ?>

		<!-- Nav -->
		<?php require ("navigation.php"); ?>

		<!-- Main -->
		<?php 
			$mode = 'default';
			if(isset($_GET['view']))
			{
				$mode = $_GET['view'];
			}
		?>

			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>Lobby</h2>
						<p>Lorem ipsum dolor sit amet nullam id egestas urna aliquam</p>
					</header>

					<!-- Table -->
					<?php
						$email = $_SESSION["email"];
						include_once "settings.php";
						$sql_table="Student";
						$conn = mysqli_connect($host, $user, $pwd, $sql_db);
						if (!$conn)
						{
							echo "<p>Can't connect to server</>";
							die();
						}
						//$query = "SELECT * FROM $sql_table WHERE email='$email'";
						//$result = @mysqli_query($conn, $query);
						//$info = mysqli_fetch_assoc($result);
					?>
						<section>
							<h3> 
								<?php 
									switch ($mode) 
									{
									 	case 'university':
									 		echo 'Courses';
									 		break;
									 	case 'course':
									 		echo 'Units';
									 		break;
									 	default:
									 		echo 'Browse';
									 		break;
									} 
								?>
							</h3>
							<div class="table-wrapper">
								<table>
									<thead>
										<tr>
											<th>Name</th>
											<th>Description</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Item 1</td>
											<td>Ante turpis integer aliquet porttitor.</td>
											<td>29.99</td>
										</tr>
										<tr>
											<td>Item 2</td>
											<td>Vis ac commodo adipiscing arcu aliquet.</td>
											<td>19.99</td>
										</tr>
										<tr>
											<td>Item 3</td>
											<td> Morbi faucibus arcu accumsan lorem.</td>
											<td>29.99</td>
										</tr>
										<tr>
											<td>Item 4</td>
											<td>Vitae integer tempus condimentum.</td>
											<td>19.99</td>
										</tr>
										<tr>
											<td>Item 5</td>
											<td>Ante turpis integer aliquet porttitor.</td>
											<td>29.99</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2"></td>
											<td>100.00</td>
										</tr>
									</tfoot>
								</table>
							</div>
							<h4>Alternate</h4>
							<div class="table-wrapper">
								<table class="alt">
									<thead>
										<tr>
											<th>Name</th>
											<th>Description</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Item 1</td>
											<td>Ante turpis integer aliquet porttitor.</td>
											<td>29.99</td>
										</tr>
										<tr>
											<td>Item 2</td>
											<td>Vis ac commodo adipiscing arcu aliquet.</td>
											<td>19.99</td>
										</tr>
										<tr>
											<td>Item 3</td>
											<td> Morbi faucibus arcu accumsan lorem.</td>
											<td>29.99</td>
										</tr>
										<tr>
											<td>Item 4</td>
											<td>Vitae integer tempus condimentum.</td>
											<td>19.99</td>
										</tr>
										<tr>
											<td>Item 5</td>
											<td>Ante turpis integer aliquet porttitor.</td>
											<td>29.99</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2"></td>
											<td>100.00</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</section>
				</div>
			</section>

		<!-- Footer -->
			<?php require ("footer.php"); ?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>