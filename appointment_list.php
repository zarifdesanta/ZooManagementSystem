<?php 

 	//connect to database
	include('config/db_connect.php');

	//write query for all zoo_keepers
	$sql = 'SELECT id, visitor_name, vet_name, appointment_date, your_problem FROM appoint';

	//make query & get result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$appoints = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	//free result from memory
	mysqli_free_result($result);

	//close connection
	//mysqli_close($conn);

	//print_r($zoo_keepers);

	if(isset($_POST['accept'])){

		$id_to_delete = $_POST['id_to_delete'];

		$sql = "DELETE FROM appoint WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: appointment_list.php');
		}else{
			echo "query error: " . mysqli_error($conn);
		}
	}

	mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php') ?>

	<h4 class="center grey-text">Appointment List</h4>
	
	<div class="container">
		<div class="row">
			<?php foreach ($appoints as $appoint): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class = "card-content center">
							<h6><?php echo htmlspecialchars($appoint['vet_name']); ?></h6>
							<div>Name: <?php echo htmlspecialchars($appoint['visitor_name']); ?></div>
							<div>Problem: <?php echo htmlspecialchars($appoint['your_problem']); ?></div>
							<div>Appointment Date: <?php echo htmlspecialchars($appoint['appointment_date']); ?></div>
						</div>
						<form action="appointment_list.php" method="POST">
							<div class="card-action right-align">
								<input type="hidden" name="id_to_delete" value="<?php echo $appoint['id'] ?>">
								<input type="submit" name="accept" value="Accept" class="btn brand z-depth-0">
								<!--
								<a class="brand-text" href="appoint_details.php?id=<?php echo $appoint['id'] ?>">Accept</a>-->
							</div>
						</form>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php') ?>



</html>