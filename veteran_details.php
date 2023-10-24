<?php

	include('config/db_connect.php');

	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

		$sql = "DELETE FROM veteran WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: veteran.php');
		}else{
			echo "query error: " . mysqli_error($conn);
		}
	}
	
	if(isset($_POST['appoint'])){

		/*
		$id_to_appoint = mysqli_real_escape_string($conn,$_POST['id_to_appoint']);

		//$sql = "SELECT name FROM veteran WHERE id = $id_to_appoint";
		$name = mysqli_real_escape_string($conn, $_POST['name_to_appoint']);
		$email_to_appoint = mysqli_real_escape_string($conn, $_POST['email_to_appoint']);
		//header('Location: add_appoint.php');
		*/
		
		session_start();
		$name = mysqli_real_escape_string($conn, $_POST['name_to_appoint']);

		$id = $_SESSION['id'];

		//make sql
		$sql = "SELECT username FROM user WHERE id = $id";
		
		//get query result
		$result = mysqli_query($conn,$sql);

		//fetch result in array
		$user = mysqli_fetch_assoc($result);

		$visitor_name = $user['username'];
		$appoint_date = mysqli_real_escape_string($conn, $_POST['appoint_date']);
		$problem = mysqli_real_escape_string($conn, $_POST['problem_text']);
		
		
		$insert_appoint_sql = "INSERT INTO appoint(visitor_name, vet_name, appointment_date, your_problem) VALUES('$visitor_name','$name', '$appoint_date', '$problem')";

		if(mysqli_query($conn, $insert_appoint_sql)){
			header("Location: veteran.php");
		}


		mysqli_free_result($result);
		mysqli_close($conn);
		

		/*
		echo 'Sending a mail to '. $email_to_appoint;
		$subject = "Appoint for my pet";
		$message = "";
		if(mail($email_to_appoint, $subject, $message)){
			echo "email has been sent";
		}else{
			echo "unable to send email";
		}*/

		
		/*
		if(mysqli_query($conn, $sql)){
			header('Location: veteran.php');
		}else{
			echo "query error: " . mysqli_error($conn);
		}*/
	}


	//check get request id param
	if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn, $_GET['id']);

		//make sql
		$sql = "SELECT * FROM veteran WHERE id = $id";

		//get query result
		$result = mysqli_query($conn,$sql);

		//fetch result in array
		$veteran = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);



	}

?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>

	<h2 class="center grey-text">Details</h2>

	<div class="container center">
		<?php if($veteran): ?>
			<h4><?php echo htmlspecialchars($veteran['name']) ?></h4>
			<p>Age: <?php echo htmlspecialchars($veteran['age']) ?></p>
			<p>Phone: <?php echo htmlspecialchars($veteran['phone']) ?></p>
			<p>Email: <?php echo htmlspecialchars($veteran['email']) ?></p>
			<p>Qualification: <?php echo htmlspecialchars($veteran['qualification']) ?></p>
			<p>Speciality: <?php echo htmlspecialchars($veteran['speciality']) ?></p>

			<!-- Delete form -->
			<form action="veteran_details.php" method="POST">

				<!--For admin-->
				<?php if($_SESSION['user_role'] == '0'): ?>
				<input type="hidden" name="id_to_delete" value="<?php echo $veteran['id'] ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
				<?php endif ?>

				<!--For visitor-->
				<?php if($_SESSION['user_role'] == '1'): ?>
				<!--
				<input type="hidden" name="id_to_appoint" value="<?php echo $veteran['id'] ?>">
				<input type="hidden" name="name_to_appoint" value="<?php echo $veteran['name'] ?>">
				<input type="hidden" name="email_to_appoint" value="<?php echo $veteran['email'] ?>">
				<input type="submit" name="appoint" value="Appoint" class="btn brand z-depth-0">-->
				<!--
				<a href= "mailto: <?php echo $veteran['email'] ?>" class="btn brand z-depth-0">Appoint</a>-->
				<label>Your Problem:</label>
				<input type="text" name="problem_text">
				<label>Appointment Date:</label>
				<input type="date" name="appoint_date">
				<input type="hidden" name="name_to_appoint" value="<?php echo $veteran['name'] ?>">
				
				<input type="submit" name="appoint" value="Appoint" class="btn brand z-depth-0">

				<?php endif ?>

				

			</form>

		<?php else: ?>
			<h5>No such veteran exists!</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php') ?>
</html>