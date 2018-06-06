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
		 <script src="arenaHandler.js"></script>
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
		$return = "<table id='t01' border='t'><tr>";
		$fields_num = mysqli_num_fields($sqltable);
		for($i = 0;$i < $fields_num; $i++){
			$field = mysqli_fetch_field($sqltable);
			$return .=  "<td><b>$field->name</b></td>";
		}
		$return .= "</tr>\n";
		while($row = mysqli_fetch_row($sqltable)) {
			$return .= "<tr>";
			foreach($row as $cell){
				$return .= "<td>$cell</td>";
			}
			$return .= "</tr>\n";
		}
		$return .= "</table>";
		return $return;
	}



	if (checkAuth(true) != "") {
	if(!isset($_GET['arena'])){
				$arenas = mysqli_query($conn,"SELECT * FROM Arena");
				echo "<div class=arena-container>";
				while($row = mysqli_fetch_row($arenas)){
						echo "<div class='arena'>";
						echo "<div class='arena-contents' id='name'>".$row[0]."</div>";
						echo "<div class='arena-contents' id='weather'> <bold>Weather:</bold> ".$row[1]."</div>";
						echo "<div class='arena-contents' id='cNum'> <bold>Champions:</bold> ".$row[2]."</div>";
						echo "<input class='arena-contents' id='aview-button' type='button' onclick=\"window.location.href='arenas.php?arena=".$row[0]."'\" name='$row[0]' value='View'/>";
						echo "</div>";
				}
				echo "</div>";
				mysqli_free_result($arenas);
	} else {
		if(checkAuth(false) != ""){
			$username = $_SESSION['username'];
			$queryIn = "SELECT C.cID, C.name, C.power, C.intelligence, C.endurance FROM Champions C WHERE C.username = '$username' AND C.arena IS NULL AND C.alive = 1";
			$resultIn = mysqli_query($conn, $queryIn);
			echo "<div class='add-champion'>";
			while($row = mysqli_fetch_assoc($resultIn)){
					echo "<div class='arena'>";
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

			$var = $_GET['arena'];
			$query = "SELECT * FROM Events WHERE arena = '$var'";

			$result = mysqli_query($conn, $query);
			if(!$result){
				die("Query couldn't complete");
			}
			$msg = "<div class='events'>";
			$msg .= "<h1>Events</h1>";
			$msg .= display($result);
			mysqli_free_result($result);
			$msg .= "</div>\n";
			echo $msg;

			$query = "SELECT C.cID, C.name, C.power, C.intelligence, C.endurance FROM Champions C WHERE C.arena = '$var'";

			$result = mysqli_query($conn, $query);
			if(!$result){
				die("Query couldn't complete");
			}
			$msg = "<div class=champions>";
			$msg .= "<h1>Champions</h1>";
			$msg .= display($result);
			mysqli_free_result($result);
			$msg .= "</div>";
			echo $msg;
		}
	}

		mysqli_close($conn);

	?>
 </body>
</html>
<?php } ?>
