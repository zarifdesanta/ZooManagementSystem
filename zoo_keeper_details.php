<?php

	include('config/db_connect.php');

	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

		$sql = "DELETE FROM zoo_keeper WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: zoo_keeper.php');
		}else{
			echo "query error: " . mysqli_error($conn);
		}
	}

	//check get request id param
	if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn, $_GET['id']);

		//make sql
		$sql = "SELECT * FROM zoo_keeper WHERE id = $id";

		//get query result
		$result = mysqli_query($conn,$sql);

		//fetch result in array
		$zoo_keeper = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);



	}

?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>

	<h2 class="center grey-text">Details</h2>

	<div class="container center">
		<?php if($zoo_keeper): ?>
			<h4><?php echo htmlspecialchars($zoo_keeper['name']) ?></h4>
			<p>Type: <?php echo htmlspecialchars($zoo_keeper['type']) ?></p>

			<!-- Delete form -->
			<?php if($_SESSION['user_role'] == '0'): ?>
			<form action="zoo_keeper_details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $zoo_keeper['id'] ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>
			<?php endif ?>

		<?php else: ?>
			<h5>No such zoo_keeper exists!</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php') ?>
</html>