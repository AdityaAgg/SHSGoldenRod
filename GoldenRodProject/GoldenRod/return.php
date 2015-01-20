<?php session_start();
if(!isset($_SESSION["pkuser2"])){
     header("Location: index.php");
}
include("login/php/constants.php");
?>


		
<?php
include("topnav.php");
?>		
	
<?
//creates arrayTeachers
$arrayTeachers=array();
$connectorer= new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$querierer=$connectorer->query("SELECT * FROM Teacher");
while ($rowerer=$querierer->fetch_assoc()) {
     $arrayTeachers[]=$rowerer['teachername'];
}
mysqli_kill($connectorer, mysqli_thread_id($connectorer));
mysqli_close($connectorer);

//Javascript array format convert
$array=json_encode($arrayTeachers);
?>       

<html>  
     <head>
	  <title>Golden Rod</title>
	  <link rel="stylesheet" href="css/styles.css" />
	  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	  <script>
	  $(function() {
	  <?
	  echo" var availableTags =  ".$array.";\n";
	  ?>  
	  $( "#teacher_name" ).autocomplete({
	       source: availableTags
	  });
	       });
	  </script>
</head>





  




    
    <body>
     <?php
     if ($_SESSION['submitted']=="true") {
     ?>
	  <br> <br> <h1> Thank You for submitting a golden rod! </h1>';
	  <div style="margin-left:100px">
	       <br> <a class="button" href="table.php"> Book Log </a> &nbsp; &nbsp; <a class="button" href="return.php"> Check Out Another Book </a>
	  </div>
	  <?
	       $_SESSION['submitted']="false";		
	  }else {
	       
	       
	       
	       
	       
	       //error check variables
	       $x=0;
	  ?>
	  <br>
	  <br>
	  <h1>Check Out a Book</h1>
	  <br/>
	  <form  action="return.php" class="checkout" method="post">
	       <fieldset>
		    <legend>Golden Rod</legend>
		    <div class="contact">
			 
			 
			 <!--Teacher Field-->
			 <p style="margin: 0px;color: black;"> Type your teacher's name and choose from a dropdown that will appear. If the dropdown
			 is too big, continue typing and the dropdown will become smaller.</p>
			 <label for="teacher_name" id="teacher_name_label">Teacher's Name</label> 
			 <input class="text-input" style="width: 140px" type="text" id="teacher_name" name="teacher_name" value="<?php echo $_POST['teacher_name'];?>"/>
			 <br>
			 <?php
			 if(isset($_POST['sender'])) {
			      if(!isset($_POST['teacher_name']) || empty($_POST['teacher_name'])) {
				   echo '<div class="errorimg"> Missing Teacher Name </div>';
				   $x++;
			      }
			      $y=array_search($_POST['teacher_name'],$arrayTeachers);
			      if ($y===false) {
				   echo '<div class="errorimg"> Teacher not chosen from drop down. </div>';
				   $x++;
			      }
			 }	
			 ?>
		     
		     
			 <!--Book Title-->
			 <br>
			 <br>
			 <label for="booktitle" id="booktitle_label">Book Title</label>
			 <input type="text" name="booktitle" id="booktitle" class="text-input" value="<?php echo $_POST['booktitle'];?>"/>
     
			 <br>
			 <?php
			 if(isset($_POST['sender'])) {
			      if(!isset($_POST['booktitle']) || empty($_POST['booktitle'])) {
				   echo '<div class="errorimg"> Missing Title </div>';
				   $x++;
			      }
			 }
			 ?>
		     
			 
			 
			 <!--Book ID-->
			 <br>
			 <br>
			 <label for="bookID" id="bookID_label">Book ID</label>
			 <input type="text" name="bookID" id="bookID" class="text-input" value="<?php echo $_POST['bookID'];?>"/>
	     
			 <br>
			 <?php
			 if(isset($_POST['sender'])) {
			     if(!isset($_POST['bookID']) || empty($_POST['bookID'])) {		
				     echo '<div class="errorimg"> Missing Book ID  </div>';
				     $x++;
			     
			     }elseif(!(preg_match('/^\d+$/',$_POST['bookID']))) {
				     echo '<div class="errorimg">  Book ID is not an integer </div>';
				     $x++;
			     }
			 }
			 ?>
			 
			 
			 
			 <!--Book Description-->
			 <br>
			 <br>
			 <br>
			 <label for="bookDesc" id="bookDesc_label">Please Note any Book Condition Issues:</label>
			 <textarea name="bookDesc" id="bookDesc" class="text-input" style="width: 60%; height: 100 px;" />
			 <?
			 if (isset($_POST['bookDesc'])) {
			      echo $_POST['bookDesc'];
			 }
			 ?>
			 </textarea>
			 <br>
			 <br>
			      
			      
			      
		    </div>
	       </fieldset>
	       <input type="submit"  name="sender" class="button" value="Send" />
	  </form>
	  
	  
	  
	  
	  <?php
	  //Run Golden Rod Insert Script if no error
	  if ($x==0 && isset($_POST['sender'])) {
	     $pkuser=$_SESSION['pkuser'];
	     $conb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	     $queriedb=$conb->query("INSERT INTO student_book (student_id, teacher, booktitle, bookID, bookDesc) VALUES ('$pkuser','$_POST[teacher_name]','$_POST[booktitle]','$_POST[bookID]','$_POST[bookDesc]')");
	     session_start();
	     $_SESSION['submitted']="true";
	     mysqli_kill($conb, mysqli_thread_id($conb));
	       mysqli_close($conb);
	     echo "<script> parent.window.location.reload(); </script>";
	  }
     }
     ?>
     </body>
</html>