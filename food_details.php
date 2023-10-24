<?php

	include('config/db_connect.php');

	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

		$sql = "DELETE FROM food_storage WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: food_storage.php');
		}else{
			echo "query error: " . mysqli_error($conn);
		}
	}

	if(isset($_POST['edit'])){

		$id_to_edit = mysqli_real_escape_string($conn,$_POST['id_to_edit']);
		$new_amount = mysqli_real_escape_string($conn, $_POST['new_amount']);

		$sql = "UPDATE food_storage SET amount=$new_amount WHERE id = $id_to_edit";

		if(mysqli_query($conn, $sql)){
			header('Location: food_storage.php');
		}else{
			echo "query error: " . mysqli_error($conn);
		}
	}


	//check get request id param
	if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn, $_GET['id']);

		//make sql
		$sql = "SELECT * FROM food_storage WHERE id = $id";

		//get query result
		$result = mysqli_query($conn,$sql);

		//fetch result in array
		$food = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}

?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>

	<h2 class="center grey-text">Details</h2>

	<div class="container center">
		<?php if($food): ?>
			<h4><?php echo htmlspecialchars($food['name']) ?></h4>
			<p>Amount: <?php echo htmlspecialchars($food['amount']) ?> kg</p>
			<p>Expiry Date: <?php echo htmlspecialchars($food['expiry_date']) ?></p>

			<form action="food_details.php" method="POST">


				<?php if($_SESSION['user_role'] == '3'): ?>
				<input type="hidden" name="id_to_edit" value="<?php echo $food['id'] ?>">
				<input type="text" name="new_amount" value="Insert New Amount" class="grey-text z-depth-0 center">
				<input type="submit" name="edit" value="Update" class="btn brand z-depth-0">
				<?php endif ?>

				
				<?php if($_SESSION['user_role'] == '3'): ?>
				<input type="hidden" name="id_to_delete" value="<?php echo $food['id'] ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
				<?php endif ?>
			</form>

		<?php else: ?>
			<h5>No such food exists!</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php') ?>
</html>