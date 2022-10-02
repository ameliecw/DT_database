<?php
/*Connect to the database*/
$dbcon = mysqli_connect("localhost", "ameliechowworn", "HMa2Kgw", "ameliechowworn_assessment");

if(isset($_GET['drink_sel'])){
	$id = $_GET['drink_sel'];
}else{
	$id = 1;
}

$drink_query = "SELECT drink_name, availability, price FROM drink WHERE drink_id = '"  .  $id  .  "'";
$drink_result = mysqli_query($dbcon, $drink_query);
$drink_record = mysqli_fetch_assoc($drink_result);

/*Drink query - Dropdown menu */
$all_drink_query = "SELECT drink_id, drink_name FROM drink";
$all_drink_result = mysqli_query($dbcon, $all_drink_query);
$drink_rows = mysqli_num_rows($all_drink_result);

/*Query to gather all drink items*/
$query_all_items = "SELECT * FROM drink";
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
			<p>A variety of drinks are offered, no fizzy drinks are sold to make the drinks we serve healthier.</p>
		</div>
		
		<div class="item5">
			<!-- Dropdown drinks form -->
			<h2>Select Another Drink</h2>
			<form name='drink_form' id='drink_form' method='get' action='drinks.php'>
				<!-- Dropdown menu -->
				<select id='drink_sel' name='drink_sel'>
					<!-- Options -->
					<?php
					while($all_drink_record = mysqli_fetch_assoc($all_drink_result)){
						echo "<option value = '". $all_drink_record['drink_id'] . "'>";
						echo $all_drink_record['drink_name'];
						echo "</option>";
					}
					?>
					
				</select>

				<input type='submit' name='drink_button' value='See the drink information'>
			</form>	
			<br>
			
			<h2>Drink information</h2>
			<?php
			echo "<p> Drink item: " . $drink_record['drink_name'] . "<br>";
			echo "<p> Status: " . $drink_record['availability'] . "<br>";
			echo "<p> Price: $" . $drink_record['price'] . "<br>";
			?>
			<br>

			<!--Search for a drink -->
			<h2> Search for a drink</h2>
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

				$query1 = "SELECT * FROM drink WHERE drink_name LIKE '%$search%'";
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
							echo "" . $row ['drink_name'] . " ($" . $row['price'] . ")";
							echo "<br>" . "<br>" . "<br>";
						}
						
					}else{
						while ($row = mysqli_fetch_array($query)) {
							echo "<p> Food item: " . $row ['drink_name'];
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
			<form name="sort_sel" id="sort_sel" method="get" action="drinks.php">
				<select name="sort_sel" id="sort_sel">
					<option value="">Please select a filter...</option>
					<option value="Price_LH">Price low to high</option>
					<option value="Price_HL">Price high to low</option>
					<option value="Available">Available only</option>
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
				
				//Displays all drinks
				if ($sort == "" or $sort == "All items"){
					while($row = mysqli_fetch_array($all_items_results)){
						echo '<div class="box1">';
						echo "<div class='box-item1'>" . $row['drink_name'] . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
						}
					}
				
				//Sorts drinks from the cheapest to the most expensive
				else if ($sort == "Price_LH"){
					$LH = "SELECT * from drink ORDER BY price ASC";
					$LH_result =  mysqli_query($dbcon, $LH);
					while ($row = mysqli_fetch_array($LH_result)) {
						echo '<div class="box1">';	
						echo "<div class='box-item1'>" . $row['drink_name'] . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
					}
				}
				
				//Sorts drinks from most expesive to the cheapest
				else if ($sort == "Price_HL"){
					$HL = "SELECT * from drink ORDER BY price DESC";
					$HL_result = mysqli_query($dbcon, $HL);
					while ($row = mysqli_fetch_array($HL_result)) {
						echo '<div class="box1">';	
						echo "<div class='box-item1'>" . $row['drink_name'] . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
					}
				}

				//If the user chooses only available drinks
				else if ($sort == "Available"){
					$available = "SELECT * from drink WHERE availability = 'available'";
					$available_result = mysqli_query($dbcon, $available);
					while ($row = mysqli_fetch_array($available_result)) {
						echo '<div class="box1">';	
						echo "<div class='box-item1'>" . $row['drink_name'] . "</div>";
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