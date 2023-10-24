<?php 
 	
 	include('config/db_connect.php');
	
	$errors = array('name'=>'','phone'=>'', 'payment_method'=>'');
	
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

 

 		if(empty($_POST['payment_method'])){
 			$errors['payment_method'] = 'A payment_method is required <br />';
 		} else{
 			//echo htmlspecialchars($_POST['payment_method']);
 			$payment_method = $_POST['payment_method'];
 			if(!preg_match('/^[a-zA-Z\s]+$/', $payment_method)){
 				//echo 'payment_method must be letters & spaces only';
 				$errors['payment_method'] = 'payment_method must be letters & spaces only';
 			}
 		}

 		if(array_filter($errors)){
 			//send error
 		}else{

 			
 			$name = mysqli_real_escape_string($conn, $_POST['name']);
 			$phone = mysqli_real_escape_string($conn, $_POST['phone']);
 	
 			$payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

 			$sql = "INSERT INTO ticket(name, phone, payment_method) VALUES('$name','$phone', '$payment_method')";

			
 			if(mysqli_query($conn, $sql)){
 				//success
 				header('Location: ticket_details.php');
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
			Buy a Ticket
		</h4>
		<form class="white" action="add_ticket.php" method="POST">
			
			<label class="left">Name:</label>
			<input type="text" name="name">
			<div class="red-text"><?php echo $errors['name'] ?></div>
			
			<label class="left">Phone:</label>
			<input type="text" name="phone">
			<div class="red-text"><?php echo $errors['phone'] ?></div>
		
			<!--
			<label class="left">payment_method:</label>
			<input type="text" name="payment_method">
			<div class="red-text"><?php echo $errors['payment_method'] ?></div>
			-->

			<label class="left">Payment Method:</label>
			<select name="payment_method" class="browser-default">
				<option>--Select Method--</option>
				<option value="Bkash">Bkash</option>
				<option value="Nagad">Nagad</option>
				<option value="Paypal">Paypal</option>
				<option value="Visa Card">Visa Card</option>
				<option value="American Express">American Express</option>
				<option value="Baki">Baki</option>
				<option value="Flexiload">Flexiload</option>
			</select>

			<div class="center">
				
				<input type="submit" name="submit" value="Buy" class="btn brand z-depth-0"></input>
				
			</div>
		</form>
	</section>
	
	<?php include('templates/footer.php') ?>

</html>