<?php

	include('config/db_connect.php');

	$sql = 'SELECT id, name, age, phone, email, qualification, speciality FROM veteran';

	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$veterans = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>

	<h2 class="center grey-text">Veteran</h2>

	<!--For admin-->
	<?php if($_SESSION['user_role'] == '0'): ?>
	<div class="center">
		<a href="add_veteran.php" class="btn brand z-depth-0">
			Add Veteran
		</a>
	</div>
	<?php endif ?>
	
	<div class="container">
		<div class="row">
			<?php foreach ($veterans as $veteran): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class = "card-content center">
							<h6><?php echo htmlspecialchars($veteran['name']); ?></h6>
							<div><?php echo htmlspecialchars($veteran['speciality']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="veteran_details.php?id=<?php echo $veteran['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php') ?>
</html>