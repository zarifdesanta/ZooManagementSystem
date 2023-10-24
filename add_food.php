<?php 
 	
 	include('config/db_connect.php');
	
	$errors = array('name'=>'','amount'=>'');
	
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

 		if(empty($_POST['amount'])){
 			$errors['amount'] = 'An amount is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['amount']);
 			$amount = $_POST['amount'];
 			if(!filter_var($amount, FILTER_VALIDATE_INT)){
 				//echo 'amount must be letters & spaces';
 				$errors['amount'] = 'amount must be integers';
 			}
 		}

 	

 		if(array_filter($errors)){
 			//send error
 		}else{
 			
 			$name = mysqli_real_escape_string($conn, $_POST['name']);
 			$amount = mysqli_real_escape_string($conn, $_POST['amount']);
 			$expiry_date = mysqli_real_escape_string($conn, $_POST['expiry_date']);

 			$sql = "INSERT INTO food_storage(name, amount, expiry_date) VALUES('$name','$amount', '$expiry_date')";

 			if(mysqli_query($conn, $sql)){
 				//succes
 				header('Location: food_storage.php');
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
			Add a Food
		</h4>
		<form class="white" action="add_food.php" method="POST">
			
			<label class="left">Name:</label>
			<input type="text" name="name">
			<div class="red-text"><?php echo $errors['name'] ?></div>
			<label class="left">amount:</label>
			<input type="text" name="amount">
			<div class="red-text"><?php echo $errors['amount'] ?></div>
			<label class="left">Expiry Date</label>
			<input type="date" name="expiry_date"></input>


			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
			</div>
		</form>
	</section>
	
	<?php include('templates/footer.php') ?>



</html>