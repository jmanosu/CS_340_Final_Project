<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$currentpage="My Champions";
		include "pages.php";
        include "header.php";
?>
<html>
	<head>
		<title>My Champions</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "championHandler.js" > </script>
	</head>
<?php
	if (checkAuth(true) != "") {
?>
<body>
  <?php
	include 'connectvars.php';
	$msg = "Add a Champion!";
	// change the value of $dbuser and $dbpass to your username and password
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	
	$username = (string)($_SESSION['username']);
	$queryIn = "SELECT wins, credits FROM Sponsors WHERE username = '$username'";
	$resultIn = mysqli_query($conn, $queryIn);
	$userdata =  mysqli_fetch_assoc($resultIn);
	echo "<div class='account'>";
	echo "<div id='username'>".$username."</div>";
	echo "<div id='stats'> <p> <bold>Stats:</bold> <br> Wins: ".$userdata['wins']." <br> credits: ".$userdata['credits']." </p> </div>";


	echo "<div class='champions'>";

	$queryIn = "SELECT C.name, C.arena, C.level, C.exp, C.power, C.intelligence, C.endurance FROM Champions C WHERE C.username = '$username'";
	$resultIn = mysqli_query($conn, $queryIn);
	echo "<div id='champions'>";

	echo "<h4>Champions</h4>";
	echo "<table id='championtable' border='t'><tr>";
	echo "<table id='t01' border='t'><tr>";
	$fields_num = mysqli_num_fields($resultIn);
	for($i = 0;$i < $fields_num; $i++){
		$field = mysqli_fetch_field($resultIn);
		echo "<td><b>$field->name</b></td>";
	}

	while($row = mysqli_fetch_assoc($resultIn)){
		echo "<tr>";
		echo "<div class='champion'>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".(isset($row['arena']) ? $row['arena'] : "relaxing")."</td>";
		echo "<td>".$row['level']."</td>";
		echo "<td>".$row['exp']."</td>";
		echo "<td>".$row['power']."</td>";
		echo "<td>".$row['intelligence']."</td>";
		echo "<td>".$row['endurance']."</td>";
		echo "</div>";
		echo "</tr>";
	}
	echo "</table>";
	echo "</table>";
	echo "</div>";

	echo "</div>";
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Escape user inputs for security
			$username = $_GET['user'];
			$cName = mysqli_real_escape_string($conn, $_POST['cName']);
			$level = mysqli_real_escape_string($conn, $_POST['level']);
			$power = mysqli_real_escape_string($conn, $_POST['power']);
			$intel = mysqli_real_escape_string($conn, $_POST['intelligence']);
			$endu = mysqli_real_escape_string($conn, $_POST['endurance']);
			
			$queryIn = "SELECT * FROM Champions where name='$cName'";
			$resultIn = mysqli_query($conn, $queryIn);
			if(mysqli_num_rows($resultIn)>0){
				echo "<h2>Can't Add to Table</h2> There is already a Champion with that name $cName<p>";
			}
			else{
				do{
					$cID = rand(0,999);
					$queryIn = "SELECT * FROM Champions where cID='$cID'";
					$resultIn = mysqli_query($conn, $queryIn);
				}
				while(mysqli_num_rows($resultIn)>0);
				
				$query = "INSERT INTO Champions (cID,name,username,level,power,intelligence,endurance,alive) 
						VALUES ('$cID',  '$cName','$username', '$level','$power','$intel','$endu',1)";
				if(mysqli_query($conn, $query)){	
					echo '<p class="white">Your Champion is created</p>';
				} else{
					echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
				}
			}
		}
	
	
	mysqli_close($conn);

?>
	<div id = 'newChams'>
	<form method="post" id="addCham">
	<fieldset>
		<legend>Add Champions:</legend>
		<table id='addChamtable' border='t'>
		<tr>
		<td>
			<label class="labels" for="cName">Champion Name</label>
		</td>

		<td>
			<label class="labels" for="level">level</label>
		</td>
		<td>
			<label class="statlabels" for="power">power</label>
		</td>
		<td>
			<label class="statlabels" for="intelligence">intelligence</label>
		</td>
		<td>
			<label class="statlabels" for="endurance">endurance</label>
		</td>		
		</tr>
		<tr>
		<td>
			<input type="text" class="required" name="cName" id="cName" placeholder = "Input Champion's Name">
		</td>

		<td>
			<input type="number" class="required" name="level" id="level" min = 1 value = 1 onchange = REroll()>
		</td>
		<td>
			<input type="number" class="notrequired" name="power" id="power" readonly>
		</td>
		<td>
			<input type="number" class="notrequired" name="intelligence" id="intelligence" readonly>
		</td>
		<td>
			<input type="number" class="notrequired" name="endurance" id="endurance" readonly>
		</td>

		</tr>
		</table>
	</fieldset>
		<h2 id="cost"> </h2>
		  <p>
			<input type = "submit"  value = "Submit" />
			<input type = "button" value = "Reroll" onclick = REroll()>
		  </p>
	</form>
	</div>
 </body>

</html>
<?php } ?>
