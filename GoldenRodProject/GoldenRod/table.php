<?php
	session_start();
	if(!isset($_SESSION['pkuser2'])) {
		header('Location: index.php');
	}
	include("login/php/constants.php");	
?>

<html>
	
	<head>
		<title>Golden Rod</title>
		<link rel="stylesheet" href="css/styles.css" />
	</head>
	
	<body>
	
	<?php include("topnav.php");
	?>
	<br/>
	<br>
	<h1>Books You Have Checked Out</h1> <br/>
	<div class="table">
	<?php
		include('showbook.php');
	?>
	</div>	
	<br/>
	</body>

</html>

