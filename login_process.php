<?php
	session_start();
	if(isset($_POST["username"]) && isset($_POST["password"]))
	{
		$email = $_POST["username"];
		$password = md5($_POST["Password"]);
		if($email!='')
		{
			if($email=='guest')
			{
				$_SESSION["username"] = "guest";
				header("location:index.php");
			}
			else
			{
				include_once "settings.php";
				$sql_table="users";
				$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

				$query = "SELECT firstName, email, password FROM $sql_table WHERE email='$email'";
				$result = @mysqli_query($conn, $query);
				if($result){
					$row = mysqli_fetch_assoc($result);
					if($row['password']==$password){
							$_SESSION["email"] = $email;
							$_SESSION["name"] = $row['firstName'];
							echo "<p class='error'> Correct password </p>";
							header("location:index.php");
					}else{
						header("location:login.php?error='Wrong username password combination'");
					}
				}else{
					header("location:login.php?error=Cant connect to database, please try again");
				}
			}
			
		}else{
			header("location:login.php?error='Please enter a valid email address'");
		}
	}else{
		header("location:login.php");
	}
?>