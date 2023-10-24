<?php 
 	
 	include('config/db_connect.php');
	
	$errors = array('name'=>'','description'=>'','type'=>'', 'vaccination'=>'');
	
	if(isset($_POST['submit'])){


	  	
  		//$result = mysqli_query($conn, "SELECT * FROM animal");


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

 		/*
 		if(empty($_POST['description'])){
 			$errors['description'] = 'An description is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['description']);
 			$des = $_POST['description'];
 			if(!preg_match('/^[a-zA-Z\s]+$/', $des)){
 				//echo 'description must be letters & spaces';
 				$errors['description'] = 'description must be letters & spaces';
 			}
 		}*/

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

 		if(empty($_POST['vaccination'])){
 			$errors['vaccination'] = 'A vaccination number is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['vaccination']);
 			$vaccination = $_POST['vaccination'];
 			if(!preg_match('/^[a-zA-Z\s]+$/', $vaccination)){
 				//echo 'vaccination must be letters & spaces';
 				$errors['vaccination'] = 'vaccination must be letters & spaces';
 			}
 		}

 		if(array_filter($errors)){
 			//send error
 		}else{

 			$image = $_POST['image'];
	  		$img_dir = "animal_image/".basename($image);
	  		
 			$name = mysqli_real_escape_string($conn, $_POST['name']);
 			$description = mysqli_real_escape_string($conn, $_POST['description']);
 			$type = mysqli_real_escape_string($conn, $_POST['type']);
 			$vaccination = mysqli_real_escape_string($conn, $_POST['vaccination']);


 			$sql = "INSERT INTO animal(name, description, type, vaccination, image) VALUES('$name','$description','$type', '$vaccination', '$img_dir')";
	  

 			if(mysqli_query($conn, $sql)){
 				//succes
 				header('Location: index.php');
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
			Add an Animal
		</h4>
		<form class="white" action="add_animal.php" method="POST">
			
			<label class="left">Name:</label>
			<input type="text" name="name">
			<div class="red-text"><?php echo $errors['name'] ?></div>
			<label class="left">Description:</label>
			<input type="text" name="description">
			<div class="red-text"><?php echo $errors['description'] ?></div>


			<label class="left">Class:</label>
			<select name="type" class="browser-default">
				<option>--Select Class--</option>
				<option value="Agnatha">Agnatha</option>
				<option value="Chrondrichtyes">Chrondrichtyes</option>
				<option value="Osteichthyes">Osteichthyes</option>
				<option value="Amphibia">Amphibia</option>
				<option value="Reptilia">Reptilia</option>
				<option value="Aves">Aves</option>
				<option value="Mammalia">Mammalia</option>
			</select>


			<div>
				<label class="left">Pick an Image:</label>
				<input type="file" name="image">
			</div>

			<!--<input type="text" name="type">
			<div class="red-text"><?php echo $errors['type'] ?></div>-->
			<label class="left">Vaccination Status:</label>
			<input type="text" name="vaccination">
			<div class="red-text"><?php echo $errors['vaccination'] ?></div>
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
			</div>
		</form>
	</section>
	
	<?php include('templates/footer.php') ?>



</html>