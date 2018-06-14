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

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Escape user inputs for security
			$username = $_SESSION['username'];
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$power = mysqli_real_escape_string($conn, $_POST['power']);
			$intelligence = mysqli_real_escape_string($conn, $_POST['intelligence']);
			$endurance = mysqli_real_escape_string($conn, $_POST['endurance']);
			$queryIn = "SELECT * FROM Sponsors where username='$username' ";
			$resultIn = mysqli_query($conn, $queryIn);
	        // See if username is already in the table
			if($username != ""){
				$queryOut = "INSERT INTO Champions (cID, name, username, power, intelligence, endurance) VALUES (100, '$name', '$username', '$power', '$intelligence', '$endurance')";
				if(mysqli_query($conn, $queryOut)){
	      	echo '<p class="white">Champion Created</p>';
				} else{
				echo "ERROR: Could not able to execute $queryOut. " . mysqli_error($conn);
				}
			}
		}

	mysqli_close($conn);

?>
	<div id = 'newChamps'>
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
			<label class="labels" for="power">power</label>
		</td>
		<td>
			<label class="labels" for="intelligence">intelligence</label>
		</td>
		<td>
			<label class="labels" for="endurance">endurance</label>
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
