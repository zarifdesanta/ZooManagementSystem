<?php 

 	//connect to database
	include('config/db_connect.php');

	//write query for all zoo_keepers
	$sql = 'SELECT id, name, type FROM zoo_keeper';

	//make query & get result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$zoo_keepers = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);

	//print_r($zoo_keepers);

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php') ?>

	<h4 class="center grey-text">Zoo Keeper</h4>

	<?php if($_SESSION['user_role'] == '0'): ?>
	<div class="center">
		<a href="add_zoo_keeper.php" class="btn brand z-depth-0">
			Add Zoo Keeper
		</a>
	</div>
	<?php endif ?>
	
	<div class="container">
		<div class="row">
			<?php foreach ($zoo_keepers as $zoo_keeper): ?>
					
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class = "card-content center">
							<h6><?php echo htmlspecialchars($zoo_keeper['name']); ?></h6>
							<div><?php echo htmlspecialchars($zoo_keeper['type']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="zoo_keeper_details.php?id=<?php echo $zoo_keeper['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php') ?>



</html>