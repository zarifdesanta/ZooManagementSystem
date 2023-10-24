<?php 

 	//connect to database
	include('config/db_connect.php');

	//write query for all foods
	$sql = 'SELECT id, name, amount, expiry_date FROM food_storage';

	//make query & get result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$foods = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);

	//print_r($foods);

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php') ?>

	<h4 class="center grey-text">Food Storage</h4>

	<?php if($_SESSION['user_role'] == '3'): ?>
	<div class="center">
		<a href="add_food.php" class="btn brand z-depth-0">
			Add Food
		</a>
	</div>
	<?php endif ?>
	
	<div class="container">
		<div class="row">
			<?php foreach ($foods as $food): ?>
					
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class = "card-content center">
							<h6><?php echo htmlspecialchars($food['name']); ?></h6>
							<div><?php echo htmlspecialchars($food['amount']); ?> Kg</div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="food_details.php?id=<?php echo $food['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php') ?>



</html>