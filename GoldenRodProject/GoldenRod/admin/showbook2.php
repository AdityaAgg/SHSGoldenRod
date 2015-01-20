<head>
    <link rel="stylesheet" href="../css/styleTable.css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script type="text/javascript">
	function doSomething() {    
	    document.getElementById("ArchiveArea").innerHTML=
	    "<button style=\"float:right\" class=\"button\" type=\"submit\" name=\"saveChange\"> Save Changes to Archive </button> <br>";
	}
    </script>
</head>


<?php
//phpdelete functions
include("../login/php/constants.php");
//for saving past search--if no past search completed then session not set so past vars won't be set
    if(isset($_POST['delete2']) || isset($_POST['saveChange']) || isset($_POST['deleter']) || isset($_POST['globaler']) || isset($_POST['archivedelete1']) || isset($_POST['deleteStudent']))
    {
	    $_POST['studentname']=$_SESSION['studentname'];
	    $_POST['studentID']=$_SESSION['studentID'];
	    $_POST['bookID']=$_SESSION['bookID'];
    }



//Global Delete
    if (isset($_POST['delete2'])) {
	//Truncate Student Book
	    $connect6= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $query6=$connect6->query("TRUNCATE student_book");
	    mysqli_kill($connect6, mysqli_thread_id($connect6));
	    mysqli_close($connect6);
	
	//Truncate Users
	    $connect7= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $query7=$connect7->query("TRUNCATE users");
	    mysqli_kill($connect7, mysqli_thread_id($connect7));
	    mysqli_close($connect7);
    }



//save all changes to archive
    if (isset($_POST['saveChange'])) {
	$connect2= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$query2=$connect2->query("SELECT * FROM student_book");
	while ($row2=$query2->fetch_assoc()) {
	    $i=$row2['SubmitID'];
	    $connect3= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    if (isset($_POST['Archiver'.$i])) {
		if ($row2['Archive']==0) {		
		    $query3=$connect3->query("UPDATE student_book SET Archive=1 WHERE SubmitID='$i'");
		}
	    mysqli_kill($connect3, mysqli_thread_id($connect3));
	    mysqli_close($connect3);
	    } else {
		if($row2['Archive']==1) {
		    $query3=$connect3->query("UPDATE student_book SET Archive=0 WHERE SubmitID='$i'");
		}
	    }
	}
 	mysqli_kill($connect2, mysqli_thread_id($connect2));
	mysqli_close($connect2);
    }

    
    
//deleter
    if (isset($_POST['deleter'])) {
	$deleter=$_POST['deleter'];
	$connect= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);   
	$querieder=$connect->query("DELETE FROM student_book WHERE SubmitID='$deleter'");
	mysqli_kill($connect, mysqli_thread_id($connect));
	mysqli_close($connect);
    }




//Global Senior Delete
    if(isset($_POST['globaler'])) {  
	//delete from student book
	    $connectb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $queryb=$connectb->query("SELECT pk_user FROM users WHERE Grader='12'");
	    
	    while ($rowersb=$queryb->fetch_assoc()) {
		$pkuser=$rowersb['pk_user'];
		$connectc= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		$queryc=$connectc->query("DELETE FROM student_book WHERE student_id='$pkuser'");
		mysqli_kill($connectc, mysqli_thread_id($connectc));
		mysqli_close($connectc);	
	    }
	    mysqli_kill($connectb, mysqli_thread_id($connectb));
	    mysqli_close($connectb);
	
	//delete users
	    $connectd= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $queryd=$connectd->query("DELETE FROM users WHERE Grader='12'");
	    mysqli_kill($connectd, mysqli_thread_id($connectd));
	    mysqli_close($connectd);
    }



//Global Archive Delete
    if (isset($_POST['archivedelete1'])) {
	$connect5= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$query5=$connect5->query("DELETE FROM student_book WHERE Archive='0'");
	mysqli_kill($connect5, mysqli_thread_id($connect5));
	mysqli_close($connect5);
    }

//Warn for student delete if no search by student ID
    if (isset($_POST['deleteStudent']) && !isset($_POST['studentID'])) {
	echo ' <br> <div style="margin-left:10px;" class="errorimg"> Must search with student ID in order to delete a student. </div> <br> <br> ';
    }
 
 
//Delete Student Function
function deleteStudent($userIDer) {
	$cone=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$queriede=$cone->query("DELETE FROM student_book WHERE student_id='$userIDer'");
	mysqli_kill($cone, mysqli_thread_id($cone));
	mysqli_close($cone);
	
	$conf=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$queriedf=$conf->query("DELETE FROM users WHERE pk_user='$userIDer'");
	mysqli_kill($conf, mysqli_thread_id($conf));
	mysqli_close($conf);
    }
?>

<?
//Global Search Function

    function globalsearch($rowb,$rower) {
	$submiter=$rowb['SubmitID'];
	echo '<tr>
		
		<td> <form action="admin.php" method="post">
		<button name="deleter" class="deleter" type="submit" value="'.$submiter.'" style="float:left;">
		<i class="icon-remove"> </i></button> </form>
		</td>
		
		<td>'. $rower['flname']. '</td>
		<td>'. $rower['st_id'].'</td>
		<td>'. $rowb['Time'].'</td> 
		<td>'. $rowb['booktitle'].'</td>
		<td>'.$rowb['teacher'].'</td>
		<td>'.$rowb['bookID'].'</td>
		<td>'.$rowb['BookDesc'].'</td>';
	if ($rowb['Archive']==0) {
	    echo '<td onclick="doSomething()"> <input type="checkbox" name="Archiver'.$submiter.'" value="true"> </td>';
	}
	else
	{
	    echo '<td onclick="doSomething()"> <input type="checkbox" name="Archiver'.$submiter.'" value="true" checked> </td>';
	}
	echo '
	</tr>
	';
    }
?>



<!--Archive Button Start Code-->
<form method="post" action="admin.php">
<div id="ArchiveArea"> <br> </div>
<br>







<!--Actual Table Start-->
<table id="hor-minimalist-b">
    <thead>
    	<tr>
	    <th> </th>	
	    <th scope="col">Student Name</th>
            <th scope="col">Student ID</th>
	    <th scope="col"> Date and Time </th>
            <th scope="col">Title</th>
            <th scope="col">Teacher</th>
            <th scope="col">ID</th>
	    <th scope="col">Book Condition</th>
	    <th scope="col">Archive </th>
        </tr>
    </thead>
    
    
    <tbody>
	<? 
	
	
	//Order values aplhabetically
	  if (!isset($_POST['studentname'], $_POST['studentID'], $_POST['bookID'])) {
	    
	    //Order Alphabetically
	    $cont=  new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $queriedt=$cont->query("SELECT * FROM users ORDER BY flname ASC");
	    
	    
	    //Display
	    while ($rower=$queriedt->fetch_assoc()) {
		$userStarter=$rower['pk_user'];
		$conb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		$queriedb=$conb->query("SELECT * FROM student_book WHERE student_id='$userStarter'");
		while($rowb = $queriedb->fetch_assoc())
		{
		    globalsearch($rowb,$rower);
		}
		mysqli_kill($conb, mysqli_thread_id($conb));
		mysqli_close($conb);
	    }	
	    mysqli_kill($cont, mysqli_thread_id($cont));
	    mysqli_close($cont);
	
	 
	 
	 
	//Search by Book ID
	  } elseif (isset($_POST['bookID']) && !empty($_POST['bookID'])) {  
	    $bookID=$_POST['bookID'];
	    $conb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $queriedb=$conb->query("SELECT * FROM student_book where bookID='$bookID'");
	    while($rowb = $queriedb->fetch_assoc())
	    {
		$userIDERS=$rowb['student_id'];
		$connetctor=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		$querier=$connetctor->query("SELECT * FROM users WHERE pk_user='$userIDERS'");
		$rower=$querier->fetch_assoc();
		globalsearch($rowb,$rower);
		mysqli_kill($connetctor, mysqli_thread_id($connetctor));
		mysqli_close($connetctor);
	    }
	    mysqli_kill($conb, mysqli_thread_id($conb));
	    mysqli_close($conb);
	  }
	  
	  
	  
	//Search by student name
	  elseif (!isset($_POST['studentID']) || empty($_POST['studentID'])) { 
	    $studentname=$_POST['studentname'];
	    $con= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $queried=$con->query("SELECT * FROM users WHERE flname='$studentname'");
	    while ($rower=$queried->fetch_assoc()) {
		$userIDer=$rower['pk_user'];
		$conb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		$queriedb=$conb->query("SELECT * FROM student_book where student_id='$userIDer'");
		while($rowb = $queriedb->fetch_assoc())
		{
		    globalsearch($rowb,$rower);
		}
		mysqli_kill($conb, mysqli_thread_id($conb));
		mysqli_close($conb);
	    }
	    mysqli_kill($con, mysqli_thread_id($con));
	    mysqli_close($con);
	  }
	  
	  
	//search by studentID 
	  elseif (!isset($_POST['studentname']) || empty($_POST['studentname'])) {
	    $studentID=$_POST['studentID'];
	    $con= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $queried=$con->query("SELECT * FROM users WHERE st_id='$studentID'");
	    $rower=$queried->fetch_assoc();
	    $userIDer=$rower['pk_user'];
	
	
	
	
	    //Delete Student
	    if (isset($_POST['deleteStudent'])) {
		deleteStudent($userIDer);
	    }
	
	    
	
	
	    $conb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $queriedb=$conb->query("SELECT * FROM student_book where student_id='$userIDer'");
	
	    while($rowb = $queriedb->fetch_assoc())
		{
		    globalsearch($rowb,$rower);
		}
	    mysqli_kill($conb, mysqli_thread_id($conb));
	    mysqli_close($conb);
	    mysqli_kill($con, mysqli_thread_id($con));
	    mysqli_close($con);
	
	
	
	//search by both student name and ID  
	  } else {
	    $studentID=$_POST['studentID'];
	    $studentname=$_POST['studentname'];

	    $cona= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $querieda=$cona->query("SELECT pk_user FROM users WHERE st_id='$studentID'");
	    $rowa=$querieda->fetch_assoc();
	    $userIDera=$rowa['pk_user'];

	    $con= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $queried=$con->query("SELECT pk_user FROM users WHERE flname='$studentname'");
	    while ($rower=$queried->fetch_assoc()) {
		$userIDer=$rower['pk_user'];  
		if ($userIDer=$userIDera) {
				
		    //Delete Student
		    if (isset($_POST['deleteStudent'])) {
			deleteStudent($userIDer);	
		    }    
		    
		    
		    
		    
		    $conb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		    $queriedb=$conb->query("SELECT * FROM student_book where student_id='$userIDer'");		
		    while($rowb = $queriedb->fetch_assoc())
			{
			    globalsearch($rowb,$rower);
			}
		    mysqli_kill($conb, mysqli_thread_id($conb));
		    mysqli_close($conb);
		} else {
		    echo '  <div style="margin-left:10px;" class="errorimg"> The student ID and Name do not match. </div> <br> <br> ';
		}
	    }  
	    mysqli_kill($con, mysqli_thread_id($con));
	    mysqli_close($con);
	    mysqli_kill($cona, mysqli_thread_id($cona));
	    mysqli_close($cona);
	  }
	?>
	
	
	
	
    </tbody>
</table>
</form>
<?
//Save search for future
$_SESSION['studentname']=$_POST['studentname'];
$_SESSION['studentID']=$_POST['studentID'];
$_SESSION['bookID']=$_POST['bookID'];
?>