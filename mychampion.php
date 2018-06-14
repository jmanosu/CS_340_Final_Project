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
	</head>
<?php
	if (checkAuth(true) != "") {
?>
<body>
	<?php
		$msg = "Add a Champion!";
	// change the value of $dbuser and $dbpass to your username and password
		include 'connectvars.php';
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
				$query = "INSERT INTO Champions (cID, name, username, power, intelligence, endurance) VALUES (100, '$name', '$username', '$power', '$intelligence', '$endurance')";
				if(mysqli_query($conn, $query)){
	      	echo '<p class="white">Champion Created</p>';
				} else{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
				}
			}
	}
	// close connection
	mysqli_close($conn);

	?>
		<section>
	    <h2> <?php echo $msg; ?> </h2>

	<form method="post" id="addForm">
	<fieldset>
		<legend>User Info:</legend>

	    <p>
	        <label for="">Name:</label>
	        <input type="text" class="required" name="name" id="name">
	    </p>

			<p>
					<label for="">Power:</label>
					<input type="number" class="required" name="power" id="power">
			</p>

			<p>
					<label for="">Intelligence:</label>
					<input type="number" class="required" name="intelligence" id="intelligence">
			</p>

			<p>
					<label for="">Endurance:</label>
					<input type="number" class="required" name="endurance" id="endurance">
			</p>

	</fieldset>

	      <p>
	        <input type = "submit"  value = "Submit" />
	        <input type = "reset"  value = "Clear Form" />
	      </p>
	</form>
 </body>
</html>
<?php } ?>
