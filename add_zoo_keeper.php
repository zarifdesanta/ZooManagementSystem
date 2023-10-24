<?php 
 	
 	include('config/db_connect.php');
	
	$errors = array('name'=>'','type'=>'');
	
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

 		if(empty($_POST['type'])){
 			$errors['type'] = 'A type number is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['type']);
 			$type = $_POST['type'];
 			if(!preg_match('/^[a-zA-Z\s]+$/', $type)){
 				//echo 'type must be letters & spaces';
 				$errors['type'] = 'type must be letters & spaces';
 			}
 		}


 		if(array_filter($errors)){
 			//send error
 		}else{
 			
 			$name = mysqli_real_escape_string($conn, $_POST['name']);
 			$type = mysqli_real_escape_string($conn, $_POST['type']);

 			$sql = "INSERT INTO zoo_keeper(name, type) VALUES('$name','$type')";

 			if(mysqli_query($conn, $sql)){
 				//succes
 				header('Location: zoo_keeper.php');
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
		<!--For admin-->
		<h4 class="center">
			Add an Zoo Keeper
		</h4>
		<form class="white" action="add_zoo_keeper.php" method="POST">
			
			<label class="left">Name:</label>
			<input type="text" name="name">
			<div class="red-text"><?php echo $errors['name'] ?></div>
			<label class="left">Type:</label>
			<input type="text" name="type">
			<div class="red-text"><?php echo $errors['type'] ?></div>
			
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
			</div>
		</form>
	</section>
	
	<?php include('templates/footer.php') ?>



</html>