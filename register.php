<?php 
 	
 	include('config/db_connect.php');

	$errors = array('username'=>'', 'password'=>'','user_role'=>'');
	
	if(isset($_POST['submit'])){
		/*
 		if(empty($_POST['id'])){
 			$errors['id'] = 'An id is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['id']);
 			$id = $_POST['id'];
 			if(!filter_var($id, FILTER_VALIDATE_INT)){
 				//echo 'id must be integer';
 				$errors['id'] = 'id must be integer';
 			}
 		}*/

 		if(empty($_POST['username'])){
 			$errors['username'] = 'A username is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['username']);
 			$username = $_POST['username'];
 			if(!preg_match('/^[a-zA-Z\s]+$/', $username)){
 				//echo 'username must be letters & spaces only';
 				$errors['username'] = 'username must be letters & spaces only';
 			}
 		}

 		/*
 		if(empty($_POST['user_role'])){
 			$errors['user_role'] = 'An user_role is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['user_role']);
 			$user_role = $_POST['user_role'];
 			if(!filter_var($user_role, FILTER_VALIDATE_INT)){
 				//echo 'user_role must be letters & spaces';
 				$errors['user_role'] = 'user_role must be integers';
 			}
 		}*/

 		

 		if(array_filter($errors)){
 			//send error
 		}else{
 			
 			$username = mysqli_real_escape_string($conn, $_POST['username']);
 			$password = mysqli_real_escape_string($conn, $_POST['password']);
 			$user_role = mysqli_real_escape_string($conn, $_POST['user_role']);
 			

 			$sql = "INSERT INTO user(username, password, user_role) VALUES('$username','$password','$user_role')";

 			if(mysqli_query($conn, $sql)){
 				//succes
 				header('Location: login.php');
 			}else{
 				echo 'query error: ' . mysqli_error($conn);
 			}
 		}
 	}


?>

<!DOCTYPE html>
<html>

	<?php include('templates/login_header.php') ?>

	<section class="center grey-text">
		<h4 class="center">
			Create an Account
		</h4>
		<form class="white" action="register.php" method="POST">
			
			<label class="left">Username:</label>
			<input type="text" name="username">
			<div class="red-text"><?php echo $errors['username'] ?></div>
			<label class="left">Password:</label>
			<input type="text" name="password">
			<div class="red-text"><?php echo $errors['password'] ?></div>
			<label class="left">User Role:</label>
			<input type="text" name="user_role">
			<div class="red-text"><?php echo $errors['user_role'] ?></div>
			
			<div class="center">
				<a href="login.php" class="btn brand z-depth-0">Back</a>
				<input type="submit" name="submit" value="Create" class="btn brand z-depth-0"></input>
			</div>
		</form>
	</section>
	
	<?php include('templates/footer.php') ?>



</html>