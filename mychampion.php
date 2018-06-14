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

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

	
	mysqli_close($conn);

?>
	<div class = 'newChams'>
	<form method="post" id="addCham">
	<fieldset>
		<legend>Add Champions:</legend>
		<table id='addChamtable' border='t'>
		<tr>
		<td>
			<label for="cName">Champion Name</label>
		</td>

		<td>
			<label for="level">level</label>
		</td>
		<td>
			<label for="power">power</label>
		</td>
		<td>
			<label for="intelligence">intelligence</label>
		</td>
		<td>
			<label for="endurance">endurance</label>
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
			<input type="number" class="required" name="power" id="power" readonly>
		</td>
		<td>
			<input type="number" class="required" name="intelligence" id="intelligence" readonly>
		</td>
		<td>
			<input type="number" class="required" name="endurance" id="endurance" readonly>
		</td>

		</tr>
		</table>
	</fieldset>
		<label for="cost">cost</label>
		<input type="number" class="required" name="cost" id="cost" readonly>
		  <p>
			<input type = "submit"  value = "Submit" />
			<input type = "button" value = "Reroll" onclick = REroll()>
		  </p>
	</form>
	</div>
 </body>

</html>
<?php } ?>
