<?
session_start();
?>
<br>


<link rel="stylesheet" href="../css/styleTable.css" />
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<table id="hor-minimalist-b" summary="Books Submitted by Students">
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
	
        </tr>
    </thead>
    <tbody>


<?php
include("../login/php/constants.php");

//deleter
if (isset($_POST['deleter'])) {
    $deleter=$_POST['deleter'];
     $connect= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
   
     $querieder=$connect->query("DELETE FROM student_book WHERE SubmitID='$deleter'");
     $_POST['studentname']=$_SESSION['studentname'];
     $_POST['studentID']=$_SESSION['studentID'];
     $_POST['bookID']=$_SESSION['bookID'];
     mysqli_kill($connect, mysqli_thread_id($connect));
    mysqli_close($connect);
}


//Global Senior Delete
if(isset($_POST['globaler'])) {
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
       $connectd= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
         $queryd=$connectd->query("DELETE FROM users WHERE Grader='12'");
    mysqli_kill($connectd, mysqli_thread_id($connectd));
    mysqli_close($connectd);
   
}








//Order values aplhabetically
  if (!isset($_POST['studentname'], $_POST['studentID'], $_POST['bookID'])) {
    
    $cont=  new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $queriedt=$cont->query("SELECT * FROM users ORDER BY flname ASC");

    while ($rowt=$queriedt->fetch_assoc()) {
    
	$userStarter=$rowt['pk_user'];
	$conb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$queriedb=$conb->query("SELECT * FROM student_book WHERE student_id='$userStarter'");

	while($rowb = $queriedb->fetch_assoc())
	    {
		$submiter=$rowb['SubmitID'];
    
    
    
		$connetctor=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		$querier=$connetctor->query("SELECT * FROM users WHERE pk_user='$userStarter'");
		$rower=$querier->fetch_assoc();
    
  
		echo '<tr>
			    <td> <form action="admin.php" method="post"> <button name="deleter" class="deleter" type="submit" value="'.$submiter.'" style="float:left;"><i class="icon-remove"> </i></button> </form> </td>
			    <td>'. $rower['flname']. '</td>
			    <td>'. $rower['st_id'].'</td>
			    <td>'. $rowb['Time'].'</td> 
			    <td>'. $rowb['booktitle'].'</td>
			    <td>'.$rowb['teacher'].'</td>
			    <td>'.$rowb['bookID'].'</td>
			    <td>'.$rowb['BookDesc'].'</td>
	  
		</tr>
		';
		mysqli_kill($connetctor, mysqli_thread_id($connetctor));
		mysqli_close($connetctor);
	    }
	mysqli_kill($conb, mysqli_thread_id($conb));
	mysqli_close($conb);
	}
	
 mysqli_kill($cont, mysqli_thread_id($cont));
 mysqli_close($cont);






//Search by Book ID
  } elseif (isset($_POST['bookID']) && !empty($_POST['bookID'])) {
    
    
    $bookID=$_POST['bookID'];
    $cona= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $querieda=$cona->query("SELECT * FROM student_book where bookID='$bookID'");
    while($rowa = $querieda->fetch_assoc())
	{
	$submiter=$rowa['SubmitID'];
       
       
	$userIDERS=$rowa['student_id'];
	$connetctor=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$querier=$connetctor->query("SELECT * FROM users WHERE pk_user='$userIDERS'");
	$rower=$querier->fetch_assoc();
    
    
    
    
    
    
	echo '<tr>
	    <td> <form action="admin.php" method="post"> <button name="deleter" class="deleter" type="submit" value="'.$submiter.'" style="float:left;"><i class="icon-remove"> </i></button> </form> </td>
        	<td>'. $rower['flname']. '</td>
		<td>'. $rower['st_id'].'</td>
		<td>'. $rowa['Time'].'</td>
		
		<td>'. $rowa['booktitle'].'</td>
            <td>'.$rowa['teacher'].'</td>
            <td>'.$rowa['bookID'].'</td>
	    <td>'.$rowa['BookDesc'].'</td>   
        </tr>
	';
	mysqli_kill($connetctor, mysqli_thread_id($connetctor));
	mysqli_close($connetctor);
	}

  mysqli_kill($cona, mysqli_thread_id($cona));
  mysqli_close($cona);
  }
  
  
  
  elseif (!isset($_POST['studentID']) || empty($_POST['studentID'])) {
    
    $studentname=$_POST['studentname'];
    $con= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $queried=$con->query("SELECT pk_user FROM users WHERE flname='$studentname'");
    $row=$queried->fetch_assoc();
    $userIDer=$row['pk_user'];

     $cona= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
     $querieda=$cona->query("SELECT * FROM student_book where student_id='$userIDer'");

    while($rowa = $querieda->fetch_assoc())
	{
	$submiter=$rowa['SubmitID'];
    
	$connetctor=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$querier=$connetctor->query("SELECT * FROM users WHERE pk_user='$userIDer'");
	$rower=$querier->fetch_assoc();
    
	echo '<tr>
	 <td> <form action="admin.php" method="post"> <button name="deleter" class="deleter" type="submit" value="'.$submiter.'" style="float:left;"><i class="icon-remove"> </i></button> </form> </td>
        	<td>'. $rower['flname']. '</td>
		<td>'. $rower['st_id'].'</td>
		<td>'. $rowa['Time'].'</td> 
		<td>'. $rowa['booktitle'].'</td>
            <td>'.$rowa['teacher'].'</td>
            <td>'.$rowa['bookID'].'</td>
	    <td>'.$rowa['BookDesc'].'</td>
	   
        </tr>
	';
	    mysqli_kill($connetctor, mysqli_thread_id($connetctor));
	    mysqli_close($connetctor);
	}
  

 mysqli_kill($cona, mysqli_thread_id($cona));
 mysqli_close($cona);
 mysqli_kill($con, mysqli_thread_id($con));
 mysqli_close($con);
  }
  
  elseif (!isset($_POST['studentname']) || empty($_POST['studentname'])) {
    
    $studentID=$_POST['studentID'];
    $con= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $queried=$con->query("SELECT pk_user FROM users WHERE st_id='$studentID'");
    $row=$queried->fetch_assoc();
    $userIDer=$row['pk_user'];

    $cona= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $querieda=$cona->query("SELECT * FROM student_book where student_id='$userIDer'");

    while($rowa = $querieda->fetch_assoc())
	{
    
	    $connetctor=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	    $querier=$connetctor->query("SELECT * FROM users WHERE pk_user='$userIDer'");
	    $rower=$querier->fetch_assoc();
    
	    $submiter=$rowa['SubmitID'];
	    echo '<tr>
		<td> <form action="admin.php" method="post"> <button name="deleter" class="deleter" type="submit" value="'.$submiter.'" style="float:left;"><i class="icon-remove"> </i></button> </form> </td>
        	<td>'. $rower['flname']. '</td>
		<td>'. $rower['st_id'].'</td>
		<td>'. $rowa['Time'].'</td> 
		<td>'. $rowa['booktitle'].'</td>
            <td>'.$rowa['teacher'].'</td>
            <td>'.$rowa['bookID'].'</td>
	    <td>'.$rowa['BookDesc'].'</td>
	    
        </tr>
	';
	mysqli_kill($connetctor, mysqli_thread_id($connetctor));
	mysqli_close($connetctor);
	}

 mysqli_kill($cona, mysqli_thread_id($cona));
 mysqli_close($cona);
 mysqli_kill($con, mysqli_thread_id($con));
 mysqli_close($con);
  
  } else {
    $studentID=$_POST['studentID'];
    $studentname=$_POST['studentname'];
   
   
    $con= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $queried=$con->query("SELECT pk_user FROM users WHERE flname='$studentname'");
    $row=$queried->fetch_assoc();
    $userIDer=$row['pk_user'];
    
    
    
  
    $cona= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $querieda=$cona->query("SELECT pk_user FROM users WHERE st_id='$studentID'");
    $rowa=$querieda->fetch_assoc();
    $userIDera=$rowa['pk_user'];
    
    
    if ($userIDer=$userIDera) {
		$conb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		$queriedb=$conb->query("SELECT * FROM student_book where student_id='$userIDer'");
		
		while($rowb = $queriedb->fetch_assoc())
		    {
			    $connetctor=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
			    $querier=$connetctor->query("SELECT * FROM users WHERE pk_user='$userIDer'");
			    $rower=$querier->fetch_assoc();
    
			    $submiter=$rowb['SubmitID'];
			    echo '<tr>
			    <td> <form action="admin.php" method="post"> <button class="deleter" type="submit" name="deleter" value="'.$submiter.'" style="float:left;"><i class="icon-remove"> </i></button> </form> </td>
			    <td>'. $rower['flname']. '</td>
			    <td>'. $rower['st_id'].'</td>
			    <td>'. $rowb['Time'].'</td> 
			    <td>'. $rowb['booktitle'].'</td>
			    <td>'.$rowb['teacher'].'</td>
			    <td>'.$rowb['bookID'].'</td>
			    <td>'.$rowb['BookDesc'].'</td>
			  
			    </tr>
			    ';
			    mysqli_kill($connetctor, mysqli_thread_id($connetctor));
			    mysqli_close($connetctor);
		    }
	    mysqli_kill($conb, mysqli_thread_id($conb));
	    mysqli_close($conb);
	    }
     else {
	echo ' <br>  <div style="margin-left:10px;" class="errorimg"> The student ID and name do not match the same student. </div> <br> <br> <br>';
     }
     


    mysqli_kill($cona, mysqli_thread_id($cona));
    mysqli_close($cona);
    mysqli_kill($con, mysqli_thread_id($con));
    mysqli_close($con);
  }
?>
</tbody>
</table>
<?
$_SESSION['studentname']=$_POST['studentname'];

$_SESSION['studentID']=$_POST['studentID'];
$_SESSION['bookID']=$_POST['bookID'];


?>