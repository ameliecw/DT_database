<?php
/*Connect to the database*/
$dbcon = mysqli_connect("localhost", "ameliechowworn", "HMa2Kgw", "ameliechowworn_assessment");

/* Food query - Dropdown menu*/
$all_food_query = "SELECT food_id, food_name, price, availability FROM food ORDER BY order_id ASC";
$all_food_result = mysqli_query($dbcon, $all_food_query);

/*Query to gather all food items*/
$query_all_items = "SELECT * FROM food ORDER BY food_name";
$all_items_results = mysqli_query($dbcon,$query_all_items);

?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title> WEGC Cafe</title>
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='style.css'>
	<link href="https://fonts.googleapis.com/css2?family=Fjord+One&display=swap" rel="stylesheet">
</head>
	

	
<main>

	<body>
		<div class="grid-container">
			<div class="item1">
				<header>
					<h1>Welcome :)</h1>
				</header>
			</div>

				<div class="item2">
				<nav>
					<ul>
						<li><a href = "index.php">Home</a></li>
						<li><a href = "drinks.php">Drinks</a></li>
						<li><a href = "food.php">Food</a></li>
						<li><a href = "weekly_specials.php">Weekly specials</a></li>
					</ul>
				</nav>
			</div>
			
			<div class="item3">
				Intro Intro Intro Intro Intro Intro Intro Intro
			</div>
			
			<div class="item4">
				<h2>All Food items</h2>
				<p>All food items are in alphabetical order.</p>
				<div class="grid">
					<?php
					while($row = mysqli_fetch_array($all_items_results)){
						echo '<div class="box1">';
						echo "<div class='box-item1'>" . $row['food_name'] . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
					}
					?>
				</div>
			</div>
			
			<div class="item5">
				Sidebar Sidebar Sidebar Sidebar Sidebar 
			</div>
	
			<div class="item6">
				<footer>
					<p>&copy; 2022 A Chow Worn. </p>
				</footer>
			</div>
			
		</div>
	</body>
	
</main>
</html>