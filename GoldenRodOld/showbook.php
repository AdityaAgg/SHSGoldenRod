<? session_start();
?>
<link rel="stylesheet" href="css/styleTable.css" />
<table id="hor-minimalist-b" summary="Checked Out Books">
    <thead>
    	<tr>
		<th scope="col">Date and Time </th>
        	<th scope="col">Title</th>
            <th scope="col">Teacher</th>
            <th scope="col">ID</th>
	     <th scope="col">Book Condition</th>
        </tr>
    </thead>
    <tbody>

<?php
require_once("login/php/constants.php");
$pkuser=$_SESSION['pkuser'];
$conb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$queriedb=$conb->query("SELECT * FROM student_book WHERE student_id='$pkuser'");
$x=0;
while($row = $queriedb->fetch_assoc())
{
	$x++;
	echo '
    	<tr>
		<td>'.$row['Time']. '</td>
        	<td>'. $row['booktitle'].'</td>
            <td>'.$row['teacher'].'</td>
            <td>'.$row['bookID'].'</td>
	    <td>'.$row['BookDesc'].'</td>
        </tr>
    ';
}

?>
    </tbody>
<?php
if($x==0) {
	
	echo ' <br> <center> You have no golden rods submitted. <a href="return.php"> Start filling out a Golden Rod. </a> </center> ';
}
?>
    
</table>
<?

mysqli_kill($conb, mysqli_thread_id($conb));
mysqli_close($conb);
?>

