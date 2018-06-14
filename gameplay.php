<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$currentpage="account";
		include "pages.php";
?>
<?php include 'header.php';?>
<html>
	<head>

		<link rel="stylesheet" href="index.css">
	</head>
<body>

<?php
  include 'connectvars.php';

  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$conn) {
    die('Could not connect: ' . mysql_error());
  }

	$battle = array();

  $queryIn = "SELECT * FROM Arena";
  $arenas = mysqli_query($conn, $queryIn);
  while($arena = mysqli_fetch_assoc($arenas)){
    $queryIn = "SELECT * FROM Champions WHERE arena = '".$arena["name"]."'";
    $champions = mysqli_query($conn, $queryIn);
		$tempc = array();
		$tempa = array();
		if(mysqli_num_rows($champions)){
			while($champion = mysqli_fetch_assoc($champions)){
				array_push($tempc, $champion);
			}
			$tempa["arena"] = $arena['name'];
			$tempa["weather"] = $arena['weather'];
			$tempa["champions"] = $tempc;
			array_push($battle, $tempa);
		}
  }

	foreach($battle as $arena){
		$count = 30;
		while($count--){
			$swap1 = rand() % count($arena["champions"]);
			$swap2 = rand() % count($arena["champions"]);
			$temp = $arena["champions"][$swap1];
			$arena["champions"][$swap1] = $arena["champions"][$swap2];
			$arena["champions"][$swap2] = $temp;
		}
	}

	foreach($battle as $arena){
		for(int i = 0; i < count($arena["champions"]) - 1;i+=2){
			$champion1 = $arena["champions"][i];
			$champion2 = $arena["champions"][i+1];

		}
	}
?>
