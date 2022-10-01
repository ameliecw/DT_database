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
$query_all_items = "SELECT * FROM drink ORDER BY drink_name";
$all_items_results = mysqli_query($dbcon,$query_all_items);

?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title> Cafe Drink Items</title>
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='style.css'>
	<link href="https://fonts.googleapis.com/css2?family=Fjord+One&display=swap" rel="stylesheet">
</head>
	
<main>
	<body>
	<div class="grid-container">
		<div class="item1">
		<header>
			<h1>Drinks :)</h1>
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
			<h2>Drink information</h2>
			<?php
			echo "<p> Drink item: " . $drink_record['drink_name'] . "<br>";
			echo "<p> Status: " . $drink_record['availability'] . "<br>";
			echo "<p> Price: $" . $drink_record['price'] . "<br>";
			?>

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
			
			<!--Search for a drink -->
				<h2> Search for a drink</h2>
				<form action="" method="post">
					<input type="text" name ='search'>
					<input type="submit" name="submit" value="Search">
				</form>

				<?php
				if(isset($_POST['search'])) {
					$search = $_POST['search'];

					$query1 = "SELECT * FROM drink WHERE drink_name LIKE '%$search%'";
					$query = mysqli_query($dbcon, $query1);
					$count = mysqli_num_rows($query);

					if ($count == 0){
						echo "There was no search results returned.";

					}else{
						
						while ($row = mysqli_fetch_array($query)) {
							echo $row ['drink_name'];
							echo "<br>";
						}
					}
				}
		
				?>
		</div>


			<div class="item4">
				<h2>All drink items</h2>
				<p>All drink items are in alphabetical order</p>
				<div class="grid">
					<?php
					while($row = mysqli_fetch_array($all_items_results)){
						echo '<div class="box1">';
						echo "<div class='box-item1'>" . $row['drink_name'] . "</div>";
						echo "<div class='box-item1'>" . "Status: " . $row['availability'] . "</div>";
						echo "<div class='box-item1'>" . "Price: $" . $row['price'] . "</div>";
						echo '</div>';
					}
				?>
				</div>

				
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