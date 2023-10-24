<?php

	include('config/db_connect.php');

	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

		$sql = "DELETE FROM admin WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: admin.php');
		}else{
			echo "query error: " . mysqli_error($conn);
		}
	}

	//check get request id param
	if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn, $_GET['id']);

		//make sql
		$sql = "SELECT * FROM admin WHERE id = $id";

		//get query result
		$result = mysqli_query($conn,$sql);

		//fetch result in array
		$admin = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);



	}

?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>

	<h2 class="center grey-text">Details</h2>

	<div class="container center">
		<?php if($admin): ?>
			<h4><?php echo htmlspecialchars($admin['name']) ?></h4>
			<p>Age: <?php echo htmlspecialchars($admin['age']) ?></p>
			<p>Phone: <?php echo htmlspecialchars($admin['phone']) ?></p>
			<p>Email: <?php echo htmlspecialchars($admin['email']) ?></p>

			<!-- Delete form -->
			<form action="admin_details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $admin['id'] ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

		<?php else: ?>
			<h5>No such admin exists!</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php') ?>
</html>