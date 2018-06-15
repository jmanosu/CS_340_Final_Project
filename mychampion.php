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
<<<<<<< HEAD
			$username = $_SESSION['username'];
			$queryIn = "SELECT credits FROM Sponsors WHERE username = '$username'";
			$resultIn = mysqli_query($conn, $queryIn);
			$userdata =  mysqli_fetch_assoc($resultIn);
			$name = mysqli_real_escape_string($conn, $_POST['cName']);
			$level = mysqli_real_escape_string($conn, $_POST['level']);
			$power = mysqli_real_escape_string($conn, $_POST['power']);
			$intelligence = mysqli_real_escape_string($conn, $_POST['intelligence']);
			$endurance = mysqli_real_escape_string($conn, $_POST['endurance']);
			$queryIn = "SELECT MAX(cID) AS MAX FROM Champions";
			$resultIn = mysqli_query($conn, $queryIn);
			$cID = mysqli_fetch_assoc($resultIn)['MAX'] + 1;
			$queryIn = "SELECT * FROM Sponsors where username='$username' ";
			$resultIn = mysqli_query($conn, $queryIn);
	    $cost = floor(($power + $intelligence + $endurance)/10);
			if($userdata["credits"] < $cost){
				echo'<p class="white">You do not have enough credits</p>';
			}else{
				if($username == ""){
					$queryOut = "INSERT INTO Champions (cID, name, username, level, power, intelligence, endurance) VALUES ('$cID', '$name', '$username', '$level', '$power', '$intelligence', '$endurance')";
					if(mysqli_query($conn, $queryOut)){
		      	echo '<p class="white">Champion Created</p>';
					} else{
					echo "ERROR: Could not able to execute $queryOut. " . mysqli_error($conn);
=======
			$username = $_GET['user'];
			$cName = mysqli_real_escape_string($conn, $_POST['cName']);
			$level = mysqli_real_escape_string($conn, $_POST['level']);
			$power = mysqli_real_escape_string($conn, $_POST['power']);
			$intel = mysqli_real_escape_string($conn, $_POST['intelligence']);
			$endu = mysqli_real_escape_string($conn, $_POST['endurance']);
			$cost = mysqli_real_escape_string($conn, $_POST['costs']);
			
			$queryIn = "SELECT credits FROM Sponsors where username = '$username'";
			$resultIn = mysqli_query($conn, $queryIn);
			$user = mysqli_fetch_row($resultIn);
			if($user[0] < $cost) echo'<p class="white">You do not have enough credits</p>';
			else{
				$queryIn = "UPDATE Sponsors SET credits = credits - '$cost' WHERE username = '$username'";
				$resultIn = mysqli_query($conn, $queryIn);
				
				$queryIn = "SELECT * FROM Champions where name='$cName'";
				$resultIn = mysqli_query($conn, $queryIn);
				if(mysqli_num_rows($resultIn)>0){
					echo "<h2 class = 'white'>Can't Add to Table</h2> There is already a Champion with that name $cName<p>";
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
>>>>>>> 973316a53ece62603df4260688775a8098e1a0a3
					}
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
		<input type="number" class="required" name="costs" id="costs" readonly hidden>
		  <p>
			<input type = "submit"  value = "Submit"/>
			<input type = "button" value = "Reroll" onclick = REroll()>
		  </p>
	</form>
	</div>
 </body>

</html>
<?php } ?>
