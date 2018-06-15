<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$currentpage="Arenas";
		include "pages.php";
    include "header.php";
		include "connectvars.php";
?>
<html>
	<head>
		<title>Arenas</title>
		<link rel="stylesheet" href="index.css">
		 <script type = "text/javascript" src="arenaHandler.js"></script>
	</head>

<body>
  <?php
	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		foreach($_POST as $key => $value) {
			if(isset($_GET['arena'])){
				$arena = $_GET['arena'];
				if($value == "add"){
					$queryOut = "UPDATE Champions C SET C.arena = '$arena' WHERE C.cID = '$key' ";
					$result = mysqli_query($conn, $queryOut);
					if(!$result){
						echo $queryOut;
						die("Query couldn't complete");
					}
				}
			}
		}
	}

	function display($sqltable){
		echo "<table id='t01' border='t'><tr>";
		$fields_num = mysqli_num_fields($sqltable);
		for($i = 0;$i < $fields_num; $i++){
			$field = mysqli_fetch_field($sqltable);
			echo "<td><b>$field->name</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($sqltable)) {
			echo "<tr>";
			foreach($row as $cell){
				echo "<td>$cell</td>";
			}
			echo "</tr>\n";
		}
			echo "</table>";
	}



	if (checkAuth(true) != "") {
	if(!isset($_GET['arena'])){
				$arenas = mysqli_query($conn,"SELECT * FROM Arena");
				echo "<div class=arena-container>";
				if(mysqli_num_rows($arenas) > 0 ){
					while($row = mysqli_fetch_row($arenas)){
						echo "<div class='arena'>";
						echo "<div class='arena-contents' id='name'>".$row[0]."</div>";
						echo "<div class='arena-contents' id='weather'> <bold>Weather:</bold> ".$row[1]."</div>";
						echo "<div class='arena-contents' id='cNum'> <bol>Champions:</bold> ".$row[2]."</div>";
						echo "<input class='arena-contents' id='aview-button' type='button' onclick=\"window.location.href='arenas.php?arena=".$row[0]."'\" name='$row[0]' value='View'/>";
						echo "</div>";
					}
				}
				echo "</div>";
				mysqli_free_result($arenas);
	} else {
		if(checkAuth(false) != ""){
			$username = $_SESSION['username'];
			$queryIn = "SELECT C.cID, C.name, C.power, C.intelligence, C.endurance FROM Champions C WHERE C.username = '$username' AND C.arena IS NULL AND C.alive = 1";
			$resultIn = mysqli_query($conn, $queryIn);

			echo "<div class='add-champions'>";
			while($row = mysqli_fetch_assoc($resultIn)){
					echo "<div class='add-champion'>";
					echo "<h4>".$row['name']."</h4>";
					echo "<p><bold>P:</bold> ".$row['power']."<br>";
					echo "<bold>I:</bold> ".$row['intelligence']."<br>";
					echo "<bold>E:</bold> ".$row['endurance']."</p>";
					echo "<form method='POST'>";
					echo "<input id='button' type='submit' value='add' name=".$row['cID'].">";
					echo "</form>";
					echo "</div>";
 			}
			echo "</div>";
		}

		$var = $_GET['arena'];



		echo "<h1>Champions</h1>";

			$query = "SELECT username,name,power,intelligence,endurance FROM Champions WHERE arena = '$var'";
			$result = mysqli_query($conn, $query);
			if(!$result){
				die("Query couldn't complete");
			}

			echo "<table id='t01' border='t'><tr>";
			$fields_num = mysqli_num_fields($result);
			for($i = 0;$i < $fields_num; $i++){
				$field = mysqli_fetch_field($result);
				echo "<td><b>$field->name</b></td>";
			}
			echo "</tr>\n";
			while($row = mysqli_fetch_row($result)) {
				echo "<tr>";
				echo "<td class = cOwners>$row[0]</td>";
				echo "<td class = cNames>$row[1]</td>";
				echo "<td class = cPowers>$row[2]</td>";
				echo "<td class = cIntells>$row[3]</td>";
				echo "<td class = cEndurans>$row[4]</td>";
				echo "</tr>\n";
			}
			echo "</table>";



			$queryIn = "SELECT C.username, C.name, C.power, C.intelligence, C.endurance
									FROM Graveyard G INNER JOIN Champions C ON (C.cID = G.cID)
									WHERE G.arena = '$var'";

			$resultIn = mysqli_query($conn, $queryIn);
			if(!$result){
				die("Query couldn't complete");
			}

			echo "<h1>Graveyard</h1>";

			if(mysqli_num_rows($resultIn) > 0){
				display($resultIn);
			}

			$queryIn = "SELECT C.username, C.name, C.power, C.intelligence, C.endurance
									FROM Winners W INNER JOIN Champions C ON (C.cID = W.cID)
									WHERE W.arena = '$var'";

			$resultIn = mysqli_query($conn, $queryIn);
			if(!$result){
				die("Query couldn't complete");
			}

			if(mysqli_num_rows($resultIn) > 0){
				echo "<h1>Past Winners:</h1>";
				display($resultIn);
			}


	?>
	<div id="Events">
		<h1>Events</h1>
		<textarea cols = 85 rows = 25 readonly id = 'displayEvents'></textarea>
		<br><input type = button id = 'startButton' value = 'START' onclick = areaStart()>
		<input type = submit id = 'resetButton' value = 'Submit' onclick = areaReset() hidden>
		<div hidden>
	<?php

				$query = "SELECT numChampions FROM Arena WHERE name = '$var'";
				$result = mysqli_query($conn, $query);
				if(!$result){
					die("Query couldn't complete");
				}
				$num = mysqli_fetch_row($result);
				echo "<input type = 'number' id = 'numChams' readonly value = $num[0]>";





			}
		}
		mysqli_close($conn);
		?>
	</div>
</div>

 </body>
</html>
