<?php

	include('config/db_connect.php');

	$sql = 'SELECT id, name, phone, payment_method FROM ticket';

	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	//free result from memory
	mysqli_free_result($result);

	//close connection
	

	if(isset($_POST['delete'])){
		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM ticket WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: ticket_list.php');
		}else{
			echo "query error: " . mysqli_error($conn);
		}
	}

	mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>

	<h2 class="center grey-text">Tickets</h2>
	<form action="ticket_list.php" method="POST">
		<div class="container">
			<?php foreach ($tickets as $ticket): ?>
			
			<ul class="collection">
				
				<input type="hidden" name="id_to_delete" value="<?php echo $ticket['id']?>">
				
				<li class="collection-item"><div><?php echo $ticket['id']?> | <?php echo $ticket['name'] ?> | <?php echo $ticket['payment_method'] ?><input class='btn brand z-depth-0 right' type="submit" name="delete" value="DONE"><i class="material-icons"></i></input></div></li>

				<!--
				<li class="collection-item"><div><?php echo $ticket['id']?>. <?php echo $ticket['name'] ?><a name='delete' href="ticket_list.php" class="secondary-content"><i class="material-icons">DONE</i></a></div></li>-->
			

			</ul>
			<?php endforeach ?>

		</div>
	</form>

	<?php include('templates/footer.php') ?>
</html>