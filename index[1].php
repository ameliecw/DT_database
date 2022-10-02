<?php
/*Connect to the database*/
$dbcon = mysqli_connect("localhost", "ameliechowworn", "HMa2Kgw", "ameliechowworn_assessment");

/* Food query - Dropdown menu*/
$all_food_query = "SELECT food_id, food_name, price, availability FROM food ORDER BY order_id ASC";
$all_food_result = mysqli_query($dbcon, $all_food_query);

/*Query for dietary info*/
$dietary = "SELECT food_name, availability, price, dietary from food";
$dietary_result = mysqli_query($dbcon, $dietary);

$v = "SELECT * from food WHERE dietary = 'v' AND availability = 'available'";
$v_result = mysqli_query($dbcon, $v);

$vg = "SELECT * from food WHERE dietary = 'vg' AND availability = 'available'";
$vg_result = mysqli_query($dbcon, $vg);

/*Since vegan food is also dairy free, it will gather items in both categories*/
$df = "SELECT * from food WHERE dietary = 'df' OR dietary = 'vg' AND availability = 'available'";
$df_result = mysqli_query($dbcon, $df);

/*Query to gather all food items*/
$query_all_items = "SELECT * FROM food ORDER BY food_name";
$all_items_results = mysqli_query($dbcon,$query_all_items);

?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title> WEGC Café</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, inital scale=1.0">
	<link rel='stylesheet' type='text/css' href='style.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
	

	


<body>
	<main>
		<div class="grid-container">
			<div class="item1">
				<header>
					<img src="WEGC_logo.jpg" alt="WEGC logo">
					<h1>Wellington East Girls' College Café</h1>
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
				<p>The school café is in partnership with Kāpura (a New Zealand hospitality group).</p>
				<p>Kāpura is working alongside Wellington East Girls' College's various Hospitality Programs.</p>
			</div>
			
			<div class="item4">
				<h2>Food and drinks</h2>
				<p>The Wellington East Girls' College Café has many food and drinks available to be purchased.</p>
				<p>Visit the foods page to see the informaton.</p>
				<form action="food.php">
					<button class="button">Go to the foods page</button>
				</form>
				<h2>Weekly specials</h2>
				<p>New specials are offered weekly on the website. These have a food and a drink item and are sold a cheaper price. Weekly specials are updated on a weekly basis so the content is varied for the customers.</p>
				<form action="weekly_specials.php">
					<button class="button">Go to the specials page</button>
				</form>
			</div>
			
			<div class="item5">
				<h2>Opening hours</h2>
				<p>The school café is open from 8am daily.</p>
				
				<img src="coffee_v2.jpg" alt="Coffee image">
			</div>
	
			<div class="item6">
				<footer>
					<p>&copy; 2022 A Chow Worn. Coffee image from <a target="_blank" href="https://tinyurl.com/5y29xtpk">Unsplash</a> and school logo from Wellington East Girls' College.</p>
					<p>Image does not depict what is actually sold in the café.</p>
				</footer>
			</div>
			
		</div>
	</main>
</body>
</html>