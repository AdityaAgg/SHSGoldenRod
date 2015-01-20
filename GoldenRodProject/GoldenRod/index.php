<? session_start();
?>

<?php 
include("login/php/constants.php");	


//email and password check 
if(isset($_POST['email'],$_POST['pass'])) {
    $email=$_POST['email'];
    $pass=$_POST['pass'];	
    $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $query=$con->query("SELECT * FROM users where email='$email' AND password='$pass'");
    
    //to check if 1 account exists    
    $existingCounter=0;
    
    while($row=$query->fetch_assoc()) {
	$pkuser=$row['pk_user'];
	$existingCounter++;
    }
    
    if ($existingCounter==1) {
	$_SESSION['pkuser']=$pkuser;
    }else {
	session_destroy();
    }
    
    mysqli_kill($con, mysqli_thread_id($con));
    mysqli_close($con);
    }
?>

<html>
    <head>
        <title>Golden Rod</title>
        <link rel="stylesheet" href="css/styles.css" />
    </head>
    
    
    <body>
	
    <?
    //loggedin 	        
    if(isset($_SESSION["pkuser"])){
	//local to previous if statement so must be redefined
	$pkuser=$_SESSION['pkuser'];
	$conc=mysqli_connect(DB_SERVER, DB_USER,DB_PASS,DB_NAME);
	$queryc=$conc->query("SELECT * FROM users WHERE pk_user='$pkuser'");
	$rowc=$queryc->fetch_assoc();
	$conf=$rowc['usr_is_confirmed'];
	//for confirmation link
	$st_id=$rowc['st_id'];
	//for inside account index.php link
	$flname=$rowc['flname'];
	mysqli_kill($conc,mysqli_thread_id($conc));
	mysqli_close($conc);
	
	//confirmation
	$error=0;
	if ($conf==0) {
    ?>
	    <br> <br> 		
	    <h1>Confirmation</h1> <br>	
	    <form action="index.php" class="terms" method="post">
		<fieldset>
		    Before you get started, you must go through the confirmation process.			
		    <label> Confirm your Student ID number: </label>
		    <?
		    echo '<input class="text-input" style="width: 140px" type="text" id="st_id" name="st_id" value="'.$_POST['st_id'].'"/>';
		    ?>
		    <br>
				    
		    <?
		    //ID error check
		    if(isset($_POST['sub'])) {
			if(empty($_POST['st_id'])) {
			    echo '<div class="errorimg">Student ID not Entered</div>';
			    $error++;
			}
			elseif (!(preg_match('/^\d+$/',$_POST['st_id']))) {
			    echo '<div class="errorimg">Student ID not entered as an integer</div>';
			    $error++;
			}
			elseif ($_POST['st_id']!=$st_id) {  
			    echo '<div class="errorimg">Entered ID not equal to Student ID</div>';
			    $error++;
			}
		    }
		    ?>	
		    <br>
		    <br>
		    <br>
		    <br>
		    <label> Set a New Password: </label>
		    <input class="text-input" style="width: 140px" type="password" id="pass" name="pass" />
		    <br> 
		    <?
		    //Password Error Check
		    if(isset($_POST['sub'])) {
			if(empty($_POST['pass'])) {
			    echo '<div class="errorimg">New Password not entered.</div>';
			    $error++;
			} elseif (mb_strlen(trim($_POST['pass'])) < 8) {
			    echo '<div class="errorimg">Make your password 8 characters or longer. </div>';
			    $error++;
			} else if(mb_strlen(trim($_POST['pass'])) > 20){
			    echo '<div class="errorimg">Your password is too big. </div>';
			    $error++;
			}else if (mb_eregi("^((root)|(bin)|(daemon)|(adm)|(lp)|(sync)|(shutdown)|
			(halt)|(mail)|(news)|(uucp)|(operator)|(games)|(mysql)|
			(httpd)|(nobody)|(dummy)|(www)|(cvs)|(shell)|(ftp)|(irc)|
			(debian)|(ns)|(download))$", $_POST['pass']))  {
			    echo' <div class="errorimg">Your password is not allowed. </div> ';
			    $error++;
			}
		    }
		    ?>
			    
		    <br>
		    <br>
		    <br>
		    <br>
		    <input type="checkbox" name="terms" value="true">
		    <a href="login/popup.php"> Agree to Terms of Agreement. </a>
		    &nbsp; <div style="font-size:10px"> Note: Agreeing to the terms of agreement is equivalent to you and your parents signing a golden rod sheet. </div>
		    <br> 
			    
		    <? 
		    //terms of agreement check
		    if(isset($_POST['sub'])) {
			if(!isset($_POST['terms'])) {
			    echo' <div class="errorimg"> You have not agreed to the terms of agreement. </div>';
			    $error++;
			}
		    }
				
				
		    //Confirm user    
		    if (isset($_POST['sub'])) {
			if ($error==0) {
			    $cond=mysqli_connect(DB_SERVER, DB_USER,DB_PASS,DB_NAME);
			    $pass=$_POST['pass'];
			    $queryd=$cond->query("UPDATE users SET password='$pass', usr_is_confirmed='1' WHERE pk_user='$pkuser'");
			    mysqli_kill($cond, mysqli_thread_id($cond));
			    mysqli_close($cond);
			    echo "<script> parent.window.location.reload(); </script>";
			}
		    }
		    ?>
		    <br>
		    <br>
		    <br>
		    <br>
		    <a style="float: right; margin-right:10px;" class="button" href="login/php/logout.php">Back</a>
		    <button name="sub"  class="button"> Submit </button>
		</fieldset>
	    </form>
	    <?
	} else {
	    include("topnav.php");
	    //a session that is set only if pkuser(login) and confirmation is one (true) used to identify for other links
	    $_SESSION['pkuser2']=$_SESSION['pkuser'];
	    ?>
			
	    <br> <br> 		
	    <h1>Welcome</h1>
	    <p class="special" align="center">
		<b>
		<?
		echo $flname."</b>. <br><br>
	    </p>";
	    ?>
	    
	    <div class="terms">
		<center> <div style="color:#909090;font-size:large;">  <b>	<br> Here are the Basics: <br> </b>  </div>  </center>
		<fieldset>
		    <legend style="text-align:left;">STEP 1: Filling in a Golden Rod </legend>
		    <img style="float:right;" width="240px" height="150px" src="img/CheckOut.png"/> 
		    Hit <a href="return.php"> CHECK OUT (above)</a> and fill in the form (your virtual golden rod) with the requested information.
		    The requested information includes the teacher of your class, book ID, book title, and condition of the book (new, ripped on some pages, etc).
		    A dropdown will appear as you enter the teacher name.
		    Make sure to choose a teacher name from the dropdown.	    
		</fieldset>
			
		<br> 
			
		<fieldset>
		    <legend style="text-align:left;">STEP 2: Redirect </legend>
		    <img style="float:right;" width="240px" height="150px" src="img/Redirect.png"/>
		    After filling in the Golden Rod, the application will ask you if you wish to go to your book log (all the books you have checked out) or
		    submit another book insurance form. 
		</fieldset>
		
		<br> 
			
		<fieldset>
		    <legend style="text-align:left;">STEP 3: Book Log </legend>
		    <img style="float:right;" width="240px" height="150px" src="img/tables.png"/>
		    If you click book log, you will be led to a page containing a table of all the books you have checked out. This page can also be accessed by clicking
		    the top menu bar link, <a href="table.php"> BOOK LOG (above)</a>. If a book disappears from the book log, that means you have returned the book in proper condition.
		</fieldset>
		
		<br>
		
		<fieldset>
		    <legend style="text-align:left;">Settings </legend>
		    <img style="float:right;" width="240px" height="150px" src="img/settings.png"/>
		    You can logout by clicking on the gear in the right corner.
		</fieldset>
	    </div>
	    
	    <br>
	    <br>
	    <?
	}	
    }		
    //not logged in
    else {
	?>			
	<div style="float: right; margin-right:10%; width:25%;"> 
	    <br>
	    <br>
	    <br>
	    <br>
	    <h1 align="center">Login</h1>	
	
	    <!--Login form-->   
	    <form name="login" action="index.php" align="center" method="POST" class="login">
		<label>email</label>
		<input class="inplaceError" style="width:140px;" type="text" name="email" maxlength="120" value="<?php echo $_POST['email']?>"/>
		<span></span>
	    
		<label>password</label>
		<input class="inplaceError" style="width:140px;" type="password" name="pass" maxlength="20" value="<?php echo $_POST['pass']; ?>"/>
		<span></span>     
	    
		<button class="button" id="login_button" style="color:#fff;">Login</button>
		<div class="error">
		    
		<?
		if (isset($_POST['email'],$_POST['pass'])) {
		    echo '<div class="errorimg"> The email and password combination was not found. Try Again. </div>';
		}
		?>    		
		</div>
		<br>
		<br>
		<br>
		<p>Did you forget your password? Click <a href="login/password_forget.php">here</a></p>
	    </form>    
	</div>		    
	    
	    
	    
	    
	<!--Home Page Description-->
	<div style="float: left; margin-left:10%; width:50%;">
	    <br>
	    <br>
	    <br>
	    
	    <div class="projecttitle"> Online Golden <br> Rod 
		<br> 
		<br>
	    </div>
	    
	    <div style="width:100%;color:#FFFFFF;" align="center">
		<b> Powered by: </b>
		<br>
		<br>
		<a class="linker" href="http://www.appdevclubshs.com"> <img style="border-radius:3px;"  width="110px" height="40px" src="img/SHSAppDev.png"/> <br> 
		SHS App Dev  </a>
		<br>
		<b> About: </b> The Online Golden Rod is a digitalized version of a book
		insurance system at <a class="linker"href="http://www.saratogahigh.org"> Saratoga High. </a> <br> <br>
		<b> Developer Acknowledgments: </b> Created by Aditya Aggarwal. Foundational support provided
		by Faisal Albannai and Saratoga High alumni Kabir Chandrasekher and Matt Yee. <br>
		<br>
		<br>
	    </div>
	    
	</div>		
	
	<?       
	}
	?>
    </body>
</html>