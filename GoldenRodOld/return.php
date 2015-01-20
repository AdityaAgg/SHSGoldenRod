<?php session_start();


	if(!isset($_SESSION["pkuser2"])){
			header("Location: index.php");
	}
	include("login/php/constants.php");
?>


		
<?php include("topnav.php");
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
    var availableTags = [
      "Abe, Kirk",
      "Aguayo, Leah",
      "Allen, Eileen",
      "Anzalone, Kim",
      "Aoki, Yuko",
      "Armes, Mandy",
      "Battey, Meg",
      "Bergkamp, Kim",
      "Blancett, Gordon",
      "Bohls, Carolyn",
      "Boitz, Michael",
      "Cahatol, Janny",
      "Carlino, Pam",
      "Charling, Claire",
      "Chin, Jim",
      "Clairveone, Diane",
      "Cochrum, Lisa",
      "Crase, Courtney",
      "Davey, Mike",
      "Davis, Kirk",
      "Drouin, Michele",
      "Dwyer, Todd",
      "Elliot, Brian",
      "Ellis, Richard",
      "Fan, Mariam",
      "Frangieh, Kelly",
      "Friend, Jason",
      "Garcia, Jenny",
      "Hamilton, Kristen",
      "Head, Catherine",
      "Herzman, Suzanne",
      "Keys, Amy",
      "Lenz, Cheryl",
      "Lizundia, Laura",
      "Lugo, Tim",
      "Mantle, Jennifer",
      "McCahill, Lisa",
      "McCorry, Maureen",
      "McCrystal, Jill",
      "Mead, Laressa",
      "Morelle, Margarita",
      "Nakamatsu, Kathy",
      "Narva, Andrew",
      "Nguyen, Ken K.",
      "Nicholson, Kelly",
      "Obenour, Amy",
      "Patel, Seema",
      "Perkins, Rachel",
      "Purcell, Anne",
      "Pwu, Jonathan",
      "Rector, Erick",
      "Ritchie, Natasha",
      "Rodriguex, Arnaldo",
      "Rodriguez, Gina",
      "Scola, Julie",
      "Sheehy, Jerry",
      "Slover, Kerri",
      "Thermond, Sarah",
      "Thomson, Kristen",
      "Tolley, Sariah",
      "Troxell, Debra",
      "Tseng, Sara",
      "Vitarelli Terra",
      "Voorhees, Sarah",
      "Wallace, Danny",
      "Warmuth, Audrey",
      "Weaver, Cabot",
      "Wissolik, Kelly",
      "Yielding, Bret",
      "Yim, PJ",
      "Young, Monique",
      "Yowell, Jim",
      "Torrens, Matt",
    ];
    $( "#teacher_name" ).autocomplete({
      source: availableTags
    });
  });
  </script>
</head>

<?
$arrayTeachers=
array (
     1=>"Abe, Kirk",
       2=>"Aguayo, Leah",
      3=>"Allen, Eileen",
      4=>"Anzalone, Kim",
      5=>"Aoki, Yuko",
      6=>"Armes, Mandy",
      7=>"Battey, Meg",
      8=>"Bergkamp, Kim",
      9=>"Blancett, Gordon",
      10=>"Bohls, Carolyn",
      11=>"Boitz, Michael",
      12=>"Cahatol, Janny",
      13=>"Carlino, Pam",
      14=>"Charling, Claire",
      15=>"Chin, Jim",
      16=>"Clairveone, Diane",
      17=>"Cochrum, Lisa",
      18=>"Crase, Courtney",
      19=>"Davey, Mike",
      20=>"Davis, Kirk",
      21=>"Drouin, Michele",
      22=>"Dwyer, Todd",
      23=>"Elliot, Brian",
      24=>"Ellis, Richard",
      25=>"Fan, Mariam",
      26=>"Frangieh, Kelly",
      27=>"Friend, Jason",
      28=>"Garcia, Jenny",
      29=>"Hamilton, Kristen",
      30=>"Head, Catherine",
      31=>"Herzman, Suzanne",
      32=>"Keys, Amy",
      33=>"Lenz, Cheryl",
      34=>"Lizundia, Laura",
      35=>"Lugo, Tim",
      36=>"Mantle, Jennifer",
      37=>"McCahill, Lisa",
      38=>"McCorry, Maureen",
      39=>"McCrystal, Jill",
      40=>"Mead, Laressa",
      41=>"Morelle, Margarita",
      42=>"Nakamatsu, Kathy",
      43=>"Narva, Andrew",
      44=>"Nguyen, Ken K.",
      45=>"Nicholson, Kelly",
      46=>"Obenour, Amy",
      47=>"Patel, Seema",
      48=>"Perkins, Rachel",
      49=>"Purcell, Anne",
      50=>"Pwu, Jonathan",
      51=>"Rector, Erick",
      52=>"Ritchie, Natasha",
      53=>"Rodriguex, Arnaldo",
      54=>"Rodriguez, Gina",
      55=>"Scola, Julie",
      56=>"Sheehy, Jerry",
      57=>"Slover, Kerri",
      58=>"Thermond, Sarah",
      59=>"Thomson, Kristen",
      60=>"Tolley, Sariah",
      61=>"Troxell, Debra",
      62=>"Tseng, Sara",
      63=>"Vitarelli Terra",
      64=>"Voorhees, Sarah",
      65=>"Wallace, Danny",
      66=>"Warmuth, Audrey",
      67=>"Weaver, Cabot",
      68=>"Wissolik, Kelly",
      69=>"Yielding, Bret",
      70=>"Yim, PJ",
      71=>"Young, Monique",
      72=>"Yowell, Jim",
      73=>"Torrens, Matt"
      );

      ?>








    
    <body>
<?php
if ($_SESSION['submitted']=="true") {
	
echo '<br> <br> <h1> Thank You for submitting a golden rod! </h1>';
echo ' <div style="margin-left:100px"> <br> <a class="button" href="table.php"> Book Log </a> &nbsp; &nbsp; <a class="button" href="return.php"> Check Out Another Book </a> </div>';
$_SESSION['submitted']="false";		
}
else {
	?>
	<?php
	//variables
	$x=0;
	?>
	
	
	<br>
		<br>

	<h1>Check Out a Book</h1>
	<br/>
	<div >
	<form  action="return.php" class="checkout" method="post">
	 <fieldset>
	<legend>Golden Rod</legend>
	<div class="contact">
	  

		
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
		<br>
		<br>
		<br>
		<label for="bookDesc" id="bookDesc_label">Please Note any Book Condition Issues:</label>
		<textarea name="bookDesc" id="bookDesc" class="text-input" style="width: 60%; height: 100 px;" /><?
		if (isset($_POST['bookDesc'])) {
			echo $_POST['bookDesc'];
		}
		?></textarea>
	
		<br>
	
				<?php /*
				$bookDesc = preg_replace('/\s+/', '', $_POST['bookDesc']);
				if(isset($_POST['sender'])) {
			if(!isset($bookDesc) || empty($bookDesc)) {
				echo '<div class="errorimg"> Missing Book Description </div>';
				$x++;
			}
				} */
			?>
		<br>
			<br>
		
	   
	</div>
	</fieldset>
	<input type="submit"  name="sender" class="button" value="Send" />
	</form>
<?php
if ($x==0 && isset($_POST['sender'])) {
	// echo "<p>Thank You For checking out a book. <br></p>";
		

	$pkuser=$_SESSION['pkuser'];
	

	$conb= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$queriedb=$conb->query("INSERT INTO student_book (student_id, teacher, booktitle, bookID, bookDesc) VALUES ('$pkuser','$_POST[teacher_name]','$_POST[booktitle]','$_POST[bookID]','$_POST[bookDesc]')");
	session_start();
	$_SESSION['submitted']="true";
       
	mysqli_kill($conb, mysqli_thread_id($conb));
	  mysqli_close($conb);
	echo "<script> parent.window.location.reload(); </script>";
	
}

?>
	
	
  </div>
<?
}
?>
 
</body>

</html>