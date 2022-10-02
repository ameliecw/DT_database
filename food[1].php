<?php
/*Connect to the database*/
$dbcon = mysqli_connect("localhost", "ameliechowworn", "HMa2Kgw", "ameliechowworn_assessment");

/*Define 'food_sel'*/
if(isset($_GET['food_sel'])){
	$id = $_GET['food_sel'];
}else{
	$id = 1;
}


/*Food query*/
$food_query = "SELECT food_name, availability, price, dietary FROM food WHERE food_id = '"  .  $id  .  "'";
$food_result = mysqli_query($dbcon, $food_query);
$food_record = mysqli_fetch_assoc($food_result);


/*Food query - Dropdown menu */
$all_food_query = "SELECT food_id, food_name, dietary, availability FROM food";
$all_food_result = mysqli_query($dbcon, $all_food_query);
$food_rows = mysqli_num_rows($all_food_result);


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
$query_all_items = "SELECT * FROM food";
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
	
<main>
	<body>
	<div class="grid-container">
		<div class="item1">
			<header>
				<img src="WEGC_logo.jpg" alt="WEGC logo" height="100fr" width="auto">
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
			<p>The Wellington East Girls' College café has a wide selection of food with new <a href="weekly_specials.php">specials</a> every week.</p>
			<p>All meat used in the products served is halal.</p>
		</div>
		
		<div class="item5">
			<!-- Dropdown food form -->
			<h2>Select Another Food</h2>
			<form name='food_form' id='food_form' method='get' action='food.php'>
				<!-- Dropdown menu -->
				<select id='food_sel' name='food_sel'>
					<!-- Options -->
					<?php
					while($all_food_record = mysqli_fetch_assoc($all_food_result)){
						echo "<option value = '". $all_food_record['food_id'] . "'>";
						echo $all_food_record['food_name'];
						echo "</option>";
					}
					?>
				</select>

				<input type='submit' name='food_button' value='See the food information'>
			</form>	
			<br>
			
			<h2>Food information</h2>
			<?php
			echo "<p> Food item: " . $food_record['food_name'] . "<br>";
			echo "<p> Status: " . $food_record['availability'] . "<br>";
			echo "<p> Price: $" . $food_record['price'] . "<br>";
			?>
			<br>

			
			<!--Search for a food -->
			<h2> Search for a food</h2>
			<form action="" method="post">
				<input type="text" name ='search'>
				<input type="submit" name="submit" value="Search">
			</form>
			<br>

			<?php
			if(isset($_POST['search'])) {
				$search = $_POST['search'];
			}else{
				$search = "jkasdhfklsahfskljfhs";
			}

				$query1 = "SELECT * FROM food WHERE (food_name LIKE '%$search%')";
				$query = mysqli_query($dbcon, $query1);
				$count = mysqli_num_rows($query);

				if ($count == 0){
					if ($search == "jkasdhfklsahfskljfhs"){
						echo "";
					}else{
						
						echo "There was no search results returned.";
					}

				}else{
					
					if($count > 4){
						while ($row = mysqli_fetch_array($query)){
							echo "" . $row ['food_name'] . "(" . $row['dietary'] . ")" . " ($" . $row['price'] . ")";
							echo "<br>" . "<br>" . "<br>";
						}
						
					}else{
						while ($row = mysqli_fetch_array($query)) {
							echo "<p> Food item: " . $row ['food_name'] . "(" . $row['dietary'] . ")";
							echo "<p> Price: $" . $row ['price'];
							echo "<p> Availability: " . $row ['availability'];
							echo "<br>" . "<br>" . "<br>";
						}
					}
				}
			?>
		</div>
		
		<div class="item4">
			
			<!--Sorting information-->
			<h2>Sort the information</h2>
			<form name="sort_sel" id="sort_sel" method="get" action="food.php">
				<select name="sort_sel" id="sort_sel">
					<option value="">Please select a filter...</option>
					<option value="Price_LH">Price low to high</option>
					<option value="Price_HL">Price high to low</option>
					<option value="Available">Available only</option>
					<option value="Vegetarian">Vegetarian food only</option>
					<option value="Vegan">Vegan food only</option>
					<option value="Dairy Free">Dairy free food only</option>
					<option value="All items">Remove filter</option>
				</select>
				<input type="submit" value="Filter" >
			</form>
			<br>
			
			<h2>Food items</h2>
			<?php

			if(isset($_GET['sort_sel'])){
				$id = $_GET['sort_sel'];
			}else{
				$id = 1;
			}

			if(isset($_GET['sort_sel'])) {
				$sort = $_GET['sort_sel'];
			}else{
				$sort = "";
			}
			?>
			<div class="grid">
				<?php
				//Displays all foods
				if ($sort == "" or $sort == "All items"){
					while($row = mysqli_fetch_array($all_items_results)){
						echo '<div class="box1">';
						echo "<div class='box-item1'>" . $row['food_name'] . "(" . $row['dietary'] . ")" . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
						}
					}
				
				//Sorts food from the cheapest to the most expensive
				else if ($sort == "Price_LH"){
					$LH = "SELECT * from food ORDER BY price ASC";
					$LH_result =  mysqli_query($dbcon, $LH);
					while ($row = mysqli_fetch_array($LH_result)) {
						echo '<div class="box1">';	
						echo "<div class='box-item1'>" . $row['food_name'] . "(" . $row['dietary'] . ")" . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
					}
				}

				//Sorts food from most expesive to the cheapest
				else if ($sort == "Price_HL"){
					$HL = "SELECT * from food ORDER BY price DESC";
					$HL_result = mysqli_query($dbcon, $HL);
					while ($row = mysqli_fetch_array($HL_result)) {
						echo '<div class="box1">';	
						echo "<div class='box-item1'>" . $row['food_name'] . "(" . $row['dietary'] . ")" . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
					}
				}

				//If the user chooses only available food
				else if ($sort == "Available"){
					$available = "SELECT * from food WHERE availability = 'available'";
					$available_result = mysqli_query($dbcon, $available);
					while ($row = mysqli_fetch_array($available_result)) {
						echo '<div class="box1">';	
						echo "<div class='box-item1'>" . $row['food_name'] . "(" . $row['dietary'] . ")" . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
					}
				}
				
				//If the user chooses vegetarian food
				else if ($sort == "Vegetarian"){
					while ($row = mysqli_fetch_array($v_result)) {
						echo '<div class="box1">';
						echo "<div class='box-item1'>" . $row['food_name'] . "(" . $row['dietary'] . ")" . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
					}
				}

				//If the user chooses vegan food
				else if ($sort == "Vegan"){
					while ($row = mysqli_fetch_array($vg_result)) {
						echo '<div class="box1">';
						echo "<div class='box-item1'>" . $row['food_name'] . "(" . $row['dietary'] . ")" . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
					}
				}

				//If the user chooses dairy free food
				else if ($sort == "Dairy Free"){
					while ($row = mysqli_fetch_array($df_result)) {
						echo '<div class="box1">';
						echo "<div class='box-item1'>" . $row['food_name'] . "(" . $row['dietary'] . ")" . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';

					}
				}
				?>

			</div>
		</div>

		<div class="item6">
			<footer>
				<p>&copy; 2022 A Chow Worn. School logo from Wellington East Girls' College.</p>
			</footer>
		</div>
		
	</div>
	</body>
</main>
</html>