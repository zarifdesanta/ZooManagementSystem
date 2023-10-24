<?php
	
	//admin = 0
	//visitor = 1
	//veteran = 2
	//zoo keeper = 3

	session_start();

	if(isset($_SESSION['username'])){
		header('Location: index.php');
	}

	$errors = array('username'=>'','password'=>'');

	
	if(isset($_POST['login'])){
		include('config/db_connect.php');
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = $_POST['password'];
				
		$sql = "SELECT id, username, user_role FROM user WHERE username='{$username}' AND password='{$password}'";

		$result = mysqli_query($conn, $sql) or die('query failed');

		if(mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_assoc($result)) {
				session_start();
				$_SESSION['username'] = $row['username'];
				$_SESSION['id'] = $row['id'];
				$_SESSION['user_role'] = $row['user_role'];

				header('Location: index.php');
			}
		}else{
			echo '<div class="red-text">Username and Password are not matched</div>';
		}
	}

?>



<!DOCTYPE html>
<html>
	
	<?php include('templates/login_header.php') ?>


	<section class="center grey-text">

		<h2 class="center">Login</h2>

		<form class="white" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
			
			<label class="left">Username:</label>
			<input type="text" name="username">
			<div class="red-text"><?php echo $errors['username'] ?></div>
			<label class="left">Password:</label>
			<input type="text" name="password">
			<div class="red-text"><?php echo $errors['password'] ?></div>
				
			<div class="center">
				<input type="submit" name="login" value="login" class="btn brand z-depth-0">
				<a href="register.php" class="btn brand z-depth-0">Register</a>
			</div>
		</form>

	</section>


	<?php include('templates/footer.php') ?>
</html>