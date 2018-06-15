<!DOCTYPE html>
<html>
<body>

<?php
include "connectvars.php";

	$cName = $_GET['name'];
	
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}

	$sql="UPDATE Champions SET alive = 0,arena = NULL WHERE name = '$cName'";
	$result = mysqli_query($con,$sql);

	mysqli_close($con);
?>
</body>
</html>