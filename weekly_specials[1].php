<?php
/*Connect to the database*/
$dbcon = mysqli_connect("localhost", "ameliechowworn", "HMa2Kgw", "ameliechowworn_assessment");

if(isset($_GET['special_sel'])){
	$id = $_GET['special_sel'];
}else{
	$id = 1;
}

$special_query = "SELECT week_specials.week_num, food.food_name, drink.drink_name, week_specials.availability, week_specials.new_price 
FROM food, drink, week_specials 
WHERE week_specials.food_id = food.food_id 
AND week_specials.drink_id = drink.drink_id";

$special_result = mysqli_query($dbcon, $special_query);
$special_record = mysqli_fetch_assoc($special_result);

/*specials query - Dropdown menu */
$all_special_query = "SELECT week_num FROM week_specials";
$all_special_result = mysqli_query($dbcon, $all_special_query);
$special_rows = mysqli_num_rows($all_special_result);

/*Query to gather all weekly specials items*/
$query_all_items = "SELECT * FROM week_specials ORDER BY week_num";
$all_items_results = mysqli_query($dbcon,$query_all_items);

?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title> Cafe Specials</title>
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='style.css'>
	<link href="https://fonts.googleapis.com/css2?family=Fjord+One&display=swap" rel="stylesheet">
</head>
	
<main>
	<body>
	<div class="grid-container">
		<div class="item1">
			<header>
				<h1>Weekly specials :)</h1>
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
		
		<div class="item5">
			<!-- Dropdown specials form -->
			<h2>Select Another Special</h2>
			<form name='special_form' id='special_form' method='get' action='weekly_specials.php'>
				<!-- Dropdown menu -->
				<select id='special_sel' name='special_sel'>
					<!-- Options -->
					<?php
					while($all_special_record = mysqli_fetch_assoc($all_special_result)){
						echo "<option value = '". $all_special_record['week_num'] . "'>";
						echo $all_special_record['week_num'];
						echo "</option>";
					}
					?>
				</select>

				<input type='submit' name='special_button' value='See the specials'>
			</form>	
		</div>

		<div class="item4">
			<h2>Weekly information</h2>
			<?php
			echo "<p> Week number: " . $special_record['week_num'] . "<br>";
			echo "<p> Food item: " . $special_record['food_name'] . "<br>";
			echo "<p> Drink item: " . $special_record['drink_name'] . "<br>";
			echo "<p> Status: " . $special_record['availability'] . "<br>";
			echo "<p> Cost: $" . $special_record['new_price'] . "<br>";
			?>

		</div>

		<div class="item6">
			<footer>
				<p>&copy; 2022 A Chow Worn.</p>
			</footer>
		</div>
		
	</div>
	</body>
</main>
</html>