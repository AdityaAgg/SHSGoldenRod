<?
session_start();
include("../login/php/constants.php");



if (!($_SESSION['confcode']=="NULL") && !(isset($_POST['sender'])) && !($_SESSION['reset']=="true")) {
//page redirect if conditions are met
    session_destroy();
    header("Location:adminlogin.php");
    exit;
    }else{
    ?>
    
    
    <?
    //Error Counter
	$x=0;
     ?>
    <head>
	<link rel="stylesheet" href="../css/styles.css" />
    </head>    
    
    <body>
	<h1> Reset Admin Account </h1>
        <br>
        <br>
	    
	<?
        //reset success
	    if ($_SESSION['reset']=="true")  {
                echo '<p>You have succeeded in resetting your password and username. &nbsp; &nbsp; <a href="adminlogin.php"> Back </a> </p> <br>';
                session_destroy();
            }
	?>
	
        <p> Reset the password and the username. </p>
        <br>
        <form method="post" action="resetadmin.php" class="editaccount"> 
	    <label for="useradmin" id="useradmin_label">New Username:</label>
	    <input class="text-input" style="width: 140px" type="text" id="useradmin" name="useradmin"/>
            <br>
            <?
	    //errpr check for admin
	    
	        if(isset($_POST['useradmin'])) {
		    if (!(isset($_POST['useradmin'])) || (empty($_POST['useradmin']))) {
			echo '<div class="errorimg"> Username not entered </div>';
			$x++;
		    }
                } else {
                    $x++;
                }
	    ?>
	    
            <br>
	    <label for="passadmin" id="passadmin_label">New Password:</label>
	    <input class="text-input" style="width: 140px" type="password" id="passadmin" name="passadmin"/>
            <br> 
	    <?
	    //error check for password        
	    
		if (isset($_POST['passadmin'])) {
                        if (!(isset($_POST['passadmin'])) || (empty($_POST['passadmin']))) {
                                echo '<div class="errorimg"> Password not entered </div>';
                                $x++;
                            }
           		else if(mb_strlen(trim($_POST['passadmin'])) < 8){
				echo '<div class="errorimg"> Password to short </div>';
                                $x++;
			}
			else if(mb_strlen(trim($_POST['passadmin'])) > 20){
				echo '<div class="errorimg"> Password to long </div>';
                                $x++;
			}
			else if (mb_eregi("^((root)|(bin)|(daemon)|(adm)|(lp)|(sync)|(shutdown)|
                        (halt)|(mail)|(news)|(uucp)|(operator)|(games)|(mysql)|
                        (httpd)|(nobody)|(dummy)|(www)|(cvs)|(shell)|(ftp)|(irc)|
                        (debian)|(ns)|(download))$", $_POST['passadmin']))
                        {
				echo '<div class="errorimg"> Password Error </div>';
				$x++;
                        }
		} else {
		    $x++;
                }
            ?>
                
                 
	    <br>
	    <br>
            <br>
            <input type="submit"  name="sender" class="button" value="Send" />
	    <a style="float: right; margin-right:15px;" class="button" href="adminlogin.php"> Back </a>
        </form>
        
	
	
	<!--Reset account if no errors-->    
	<?
            if ($x==0) {
            $user=$_POST['useradmin'];
            $pass=$_POST['passadmin'];            
            $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $query=$con->query("UPDATE admin SET user='$user', pass='$pass'");
            $_SESSION['reset']="true";
	    mysqli_kill($con, mysqli_thread_id($con));
	    mysqli_close($con);
            echo "<script> parent.window.location.reload(); </script>";
            }
	}
	?>
    </body>