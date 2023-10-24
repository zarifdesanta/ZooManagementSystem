<?php  

	session_start();

	if(!isset($_SESSION['username'])){
		header('Location: login.php');
	}

?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Zoo Database Management System</title>
	<!--
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-->
	<link rel="stylesheet" href="materialize/css/materialize.min.css">
	<style type="text/css">
		.brand{
			background: #069a8e !important;
		}
		.brand-text{
			color: #069a8e !important;
		}
		form{
			max-width: 460px;
			margin: 20px auto;
			padding:  20px;
		}
		.image{
			width: 100px;
			
			margin: 40px auto - 30px;
		}
		.font_cursive_style{
			font-family: cursive;
		}
	</style>
</head>
	<body class = "grey lighten-4">
		<nav class = "white z-depth-0">
			<div class = "container">
				<a href="index.php" class = "brand-logo brand-text center font_cursive_style">
					Zoo Database Management System
				</a>
				<!--
				<a class="btn brand z-depth-0 right">
					Hello <?php echo $_SESSION['username'] ?>
				</a>-->
				
			</div>
		</nav>
		<nav class = "white z-depth-0">
			<div class = "container">
				<ul id = "nav-mobile" class="hide-on-small-and-down left">
					<li>
						<a href="index.php" class="btn brand z-depth-0">
							Animal
						</a>

						<?php if($_SESSION['user_role'] == '0'): ?>
						<a href="admin.php" class="btn brand z-depth-0">
							Admin
						</a>
						<?php endif ?>

						<?php if($_SESSION['user_role'] == '0' || $_SESSION['user_role'] == '3'): ?>
						<a href="zoo_keeper.php" class="btn brand z-depth-0">
							Zoo Keeper
						</a>
						<?php endif ?>

						<?php if($_SESSION['user_role'] == '0' || $_SESSION['user_role'] == '1' || $_SESSION['user_role'] == '2'): ?>
						<a href="veteran.php" class="btn brand z-depth-0">
							Veteran
						</a>
						<?php endif ?>

						<!--
						<a href="appoint.php" class="btn brand z-depth-0">
							Appoint
						</a>-->

						<?php if($_SESSION['user_role'] == '1'): ?>
						<a href="add_ticket.php" class="btn brand z-depth-0">
							Buy Ticket
						</a>
						<?php endif ?>

						<?php if($_SESSION['user_role'] == '3'): ?>
						<a href="food_storage.php" class="btn brand z-depth-0">
							Food Storage
						</a>
						<?php endif ?>

						<?php if($_SESSION['user_role'] == '0'): ?>
						<a href="ticket_list.php" class="btn brand z-depth-0">
							Ticket
						</a>
						<?php endif ?>

						<?php if($_SESSION['user_role'] == '2'): ?>
						<a href="appointment_list.php" class="btn brand z-depth-0">
							Appointment List
						</a>
						<?php endif ?>

					</li>
				</ul>
				
				<ul id = "nav-mobile" class="right hide-on-small-and-down">
					<li>

						<a href="logout.php" class="btn brand z-depth-0"> 
							Hello <?php echo $_SESSION['username'] ?>, Log out
						</a>
					</li>
				</ul>
			</div>
		</nav>