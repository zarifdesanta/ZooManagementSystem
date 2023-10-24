<?php

	include('config/db_connect.php');



	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

		$sql = "DELETE FROM animal WHERE id = $id_to_delete";
		
		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		}else{
			echo "query error: " . mysqli_error($conn);
		}
	}
	
	//Vaccination
	if(isset($_POST['vaccinated'])){

		$id_to_vac = mysqli_real_escape_string($conn,$_POST['id_to_vac']);
		//$vaccination_date = mysqli_real_escape_string($conn, $_POST['vaccination_date']);
		//echo $vaccination_date;
		
		$sql = "UPDATE animal SET vaccination='Vaccinated', vaccination_date=DATE(NOW()) WHERE id = $id_to_vac";
		
		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		}else{
			echo "query error: " . mysqli_error($conn);
		}

	}

	//check get request id param
	if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn, $_GET['id']);

		//make sql
		$sql = "SELECT * FROM animal WHERE id = $id";

		//get query result
		$result = mysqli_query($conn,$sql);

		//fetch result in array
		$animal = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}

?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>

	
	<audio autoplay>
		<source src="animal_audio/meow_audio.wav" type="audio/wav">
	</audio>

	<h2 class="center grey-text">Details</h2>

	<div class="container center">
		<?php if($animal): ?>
			<h4><?php echo htmlspecialchars($animal['name']) ?></h4>
			<p>Class: <?php echo htmlspecialchars($animal['type']) ?></p>
			<p>Description: <?php echo htmlspecialchars($animal['description']) ?></p>
			<p>Join Date: <?php echo date($animal['created_at']) ?></p>
			<?php if($_SESSION['user_role'] != '1'): ?>
			<p>Vaccination Status: <?php echo htmlspecialchars($animal['vaccination']) ?></p>
			<p>Vaccination Date: <?php echo htmlspecialchars($animal['vaccination_date']) ?></p>
			<?php endif ?>

			
			<form action="animal_details.php" method="POST">

				<!--For admin-->
				<?php if($_SESSION['user_role'] == '0'): ?>
				<input type="hidden" name="id_to_delete" value="<?php echo $animal['id'] ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
				<?php endif ?>

				<!--For Veteran-->
				<?php if($_SESSION['user_role'] == '2'): ?>
				<input type="hidden" name="id_to_vac" value="<?php echo $animal['id'] ?>">
				
				<input type="submit" name="vaccinated" value="vaccinated" class="btn brand z-depth-0">
				<?php endif ?>
			</form>

		<?php else: ?>
			<h5>No such animal exists!</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php') ?>
</html>