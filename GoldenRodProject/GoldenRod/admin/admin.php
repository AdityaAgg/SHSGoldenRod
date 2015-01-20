<?php
//logout
session_start();
if ($_SESSION['works']!="true") {
    header('Location: endadmin.php');
}
?>
 




<html>
    <head>
        <title>Golden Rod</title>
        <link rel="stylesheet" href="../css/styles.css" />
    </head>
    <body>
	
	<?php
	include('topnavadmin.php');
	?>
	
	<br/>
	<br/>
	
		
	<h1>Admin Control Page </h1> <br/>
	
	    <div class="formatted">
		<fieldset>
		    <legend> Search </legend>
		    <form action="admin.php" method="post">
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
			&nbsp;
			<a href="admin.php"> Reset Table </a>
		    </form>	
		
		<form action="admin.php"
		      onsubmit="return confirm('This action is a delete action. Are sure you would like to continue?');"
		      method="post" style="text-align:right;">
		    
		    <button class="button"  name="globaler"> Delete All Seniors  </button>
		    <button class="button"  name="archivedelete1"> Delete All Except Archived </button>
		    <button class="button"  name="delete2"> Delete All </button>
		    <button class="button"  name="deleteStudent"> Delete Student </button>
		</form>	
	    </fieldset>
	</div>
    <br> <br>


    

    <div class="table">
    
    <?
	include('showbook2.php');	
	echo '</form> </div> ';
	?>	


	
	<br/>
    </body>
</html>