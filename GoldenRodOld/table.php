<?php session_start();

	if(!isset($_SESSION['pkuser2'])) {
			header('Location: index.php');
			}
	include("login/php/constants.php");	
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Golden Rod</title>
        
        <link rel="stylesheet" href="css/styles.css" />
    </head>
    
    <body>
	
<?php include("topnav.php");
?>
	<br/>
    <br>
	    
	<?php
		
		
			echo '<h1>Books You Have Checked Out</h1> <br/>';
			echo '	<div class="table">';
			include('showbook.php');
			echo '</div>';
		
	
	?>
	
	<br/>

    </body>
</html>

