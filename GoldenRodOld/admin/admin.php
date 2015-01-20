<?php session_start();
if ($_SESSION['works']!="true") {
    header('Location: endadmin.php');

}
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Golden Rod</title>
        
        <link rel="stylesheet" href="../css/styles.css" />
    </head>
    
    <body>
	
	<?php
	include('topnavadmin.php');
	?>
	
	<br/>
	<br/>
	<?php
	include('../login/php/constants.php');
	
		
			echo '<h1>Admin Control Page </h1> <br/>';
			
			echo ' <form action="admin.php" method="post" class="Search">
			<fieldset>
			<legend> Search </legend>
	
	<div style="color:#909090;font-size:large;">  <b> Search By: <br> </b>  </div>
	<br>
	<span style="font-weight:bold;"> Name: &nbsp; </span>
<input type="text" name="studentname" class="text/input"/>
&nbsp;

<span style="font-weight:bold;"> and/or Student ID: &nbsp; </span>
<input type="text" name="studentID" class="text/input"/>

&nbsp;
<span style="font-weight:bold; "> or Book ID: &nbsp; </span>
<input type="text" name="bookID" class="text/input"/>

<br>

<input type="submit"  class="button" value="Search" />
 
		<a href="admin.php"> Reset Table </a>
	    <form action="admin.php" method="post" style="text-align:right;">
<button class="button" type="submit" name="globaler"> Global Delete all Senior Insurance Forms </button>
    </form>	
</fieldset>
</form> <div class="table">';
			include('showbook2.php');
		
	echo '</div>';
	?>
	
	
	<br/>
    </body>
</html>