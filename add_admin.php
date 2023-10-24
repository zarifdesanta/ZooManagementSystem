<?php 
 	
 	include('config/db_connect.php');
	
	$errors = array('name'=>'','age'=>'','phone'=>'', 'email'=>'');
	
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

 		if(empty($_POST['name'])){
 			$errors['name'] = 'A name is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['name']);
 			$name = $_POST['name'];
 			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
 				//echo 'name must be letters & spaces only';
 				$errors['name'] = 'name must be letters & spaces only';
 			}
 		}

 		if(empty($_POST['age'])){
 			$errors['age'] = 'An age is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['age']);
 			$age = $_POST['age'];
 			if(!filter_var($age, FILTER_VALIDATE_INT)){
 				//echo 'age must be letters & spaces';
 				$errors['age'] = 'age must be integers';
 			}
 		}

 		if(empty($_POST['phone'])){
 			$errors['phone'] = 'A phone number is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['phone']);
 			$phone = $_POST['phone'];
 			if(filter_var($phone, FILTER_VALIDATE_INT)){
 				//echo 'phone must be letters & spaces';
 				$errors['phone'] = 'phone must be integers';
 			}
 		}

 		if(empty($_POST['email'])){
 			$errors['email'] = 'A email number is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['email']);
 			$email = $_POST['email'];
 			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
 				//echo 'email must be letters & spaces';
 				$errors['email'] = 'email must be valid a email address';
 			}
 		}

 		if(array_filter($errors)){
 			//send error
 		}else{
 			
 			$name = mysqli_real_escape_string($conn, $_POST['name']);
 			$age = mysqli_real_escape_string($conn, $_POST['age']);
 			$phone = mysqli_real_escape_string($conn, $_POST['phone']);
 			$email = mysqli_real_escape_string($conn, $_POST['email']);

 			$sql = "INSERT INTO admin(name, age, phone, email) VALUES('$name','$age','$phone', '$email')";

 			if(mysqli_query($conn, $sql)){
 				//succes
 				header('Location: admin.php');
 			}else{
 				echo 'query error: ' . mysqli_error($conn);
 			}
 		}
 	}


?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php') ?>

	<section class="center grey-text">
		<h4 class="center">
			Add an Admin
		</h4>
		<form class="white" action="add_admin.php" method="POST">
			
			<label class="left">Name:</label>
			<input type="text" name="name">
			<div class="red-text"><?php echo $errors['name'] ?></div>
			<label class="left">Age:</label>
			<input type="text" name="age">
			<div class="red-text"><?php echo $errors['age'] ?></div>
			<label class="left">Phone:</label>
			<input type="text" name="phone">
			<div class="red-text"><?php echo $errors['phone'] ?></div>
			<label class="left">Email:</label>
			<input type="text" name="email">
			<div class="red-text"><?php echo $errors['email'] ?></div>
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
			</div>
		</form>
	</section>
	
	<?php include('templates/footer.php') ?>



</html>