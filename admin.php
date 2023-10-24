<?php

	include('config/db_connect.php');

	$sql = 'SELECT id, name, age, phone, email FROM admin';

	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$admins = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>

	<h2 class="center grey-text">Admin</h2>

	<div class="center">
		<a href="add_admin.php" class="btn brand z-depth-0">
			Add Admin
		</a>
	</div>

	<div class="container">
		<div class="row">
			<?php foreach ($admins as $admin): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class = "card-content center">
							<h6><?php echo htmlspecialchars($admin['name']); ?></h6>
							<div><?php echo htmlspecialchars($admin['email']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="admin_details.php?id=<?php echo $admin['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php') ?>
</html>