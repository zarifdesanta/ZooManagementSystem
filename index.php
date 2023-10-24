<?php 

 	//connect to database
	include('config/db_connect.php');

	//write query for all animals
	$sql = 'SELECT id, name, description, type, image FROM animal ORDER BY created_at';

	//make query & get result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$animals = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	//free result from memory

	//close connection

	//print_r($animals);


	//Search logic
	if(isset($_POST['search'])){
		$keyword = mysqli_real_escape_string($conn,$_POST['keyword']);

		$search = "SELECT * FROM animal WHERE name LIKE '%{$keyword}%'";

		$result = mysqli_query($conn, $search);

		$searched_animals = mysqli_fetch_all($result, MYSQLI_ASSOC);

		/*
		foreach ($searched_animals as $animal) {
			echo $animal['name'];
		}*/
	}

	
	mysqli_free_result($result);

	mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php') ?>

	<h4 class="center grey-text">Animals</h4>

	<?php if($_SESSION['user_role'] == '0'): ?>
	<div class="center">
		<a href="add_animal.php" class="btn brand z-depth-0">
			Add Animal
		</a>
	</div>
	<?php endif ?>
	

	<!--Search system-->
	
	<form action="index.php" method="POST">
		<div class="container">
			<input type="text" name="keyword">
			<input type="submit" name="search" value="Search" class="btn brand z-depth-0">

			<?php if(isset($searched_animals)): ?>
				Results Found: <?php echo count($searched_animals); ?>
				<?php foreach ($searched_animals as $animal): ?>
					<div class="col s6 md3">
						<div class="card z-depth-0">
							
							<div class = "card-content center">
								<?php //echo htmlspecialchars($animal['image']); ?>
								<img src="<?php echo htmlspecialchars($animal['image']); ?>" class="image"></img>
								<h6><?php echo htmlspecialchars($animal['name']); ?></h6>
								<div><?php echo htmlspecialchars($animal['type']); ?></div>
							</div>
							<div class="card-action right-align">
								<a class="brand-text" href="animal_details.php?id=<?php echo $animal['id'] ?>">more info</a>
							</div>
						</div>
					</div>

				<?php endforeach ?>
			<?php else: ?>
				<?php echo "No results found" ?>
				

			<?php endif ?>
				
		</div>
	</form>

	<!--****************************-->


	<div class="container">
		<div class="row">
			<?php foreach ($animals as $animal): ?>
					
				<div class="col s4 md3">
					<div class="card z-depth-0">
						
						<div class = "card-content center">
							<?php //echo htmlspecialchars($animal['image']); ?>
							<img src="<?php echo htmlspecialchars($animal['image']); ?>" class="image"></img>
							<h6><?php echo htmlspecialchars($animal['name']); ?></h6>
							<div><?php echo htmlspecialchars($animal['type']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="animal_details.php?id=<?php echo $animal['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php') ?>



</html>