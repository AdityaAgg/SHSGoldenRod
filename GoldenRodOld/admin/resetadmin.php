<?
session_start();
include("../login/php/constants.php");
if (!($_SESSION['confcode']=="NULL") && !(isset($_POST['sender'])) && !($_SESSION['reset']=="true")) {
    session_destroy();
    header("Location:adminlogin.php");
    exit;
    
    }else{
        
        
     $x=0;   
        
    echo '
    <link rel="stylesheet" href="../css/styles.css" />

        
        <h1> Reset Admin Account </h1>
        <br>
        <br>
        ';
            if ($_SESSION['reset']=="true")  {
                echo '<p>You have succeeded in resetting your password. &nbsp; &nbsp; <a href="adminlogin.php"> Back </a> </p> <br>';
                session_destroy();
            }
        echo'
        <p> Reset the password and the username. </p>
        <br>
                    <form method="post" action="resetadmin.php" class="editaccount"> 
    <label for="useradmin" id="useradmin_label">New Username:</label>
		<input class="text-input" style="width: 140px" type="text" id="useradmin" name="useradmin"/>
                <br>';
                if(isset($_POST['useradmin'])) {
                 if (!(isset($_POST['useradmin'])) || (empty($_POST['useradmin']))) {
                            echo '<div class="errorimg"> Username not entered </div>';
                                $x++;
                 }
                } else {
                    $x++;
                }
                echo '
                <br>
                    <label for="passadmin" id="passadmin_label">New Password:</label>
		<input class="text-input" style="width: 140px" type="password" id="passadmin" name="passadmin"/>
                <br> ';
           
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
           
                
     echo '            
    <br>
        <br>
            <br>
            <input type="submit"  name="sender" class="button" value="Send" />
	        <a style="float: right; margin-right:15px;" class="button" href="adminlogin.php"> Back </a>
            </form>
            ';
            if ($x==0) {
            $cona=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $querya=$cona->query("TRUNCATE admin");
            
            $user=$_POST['useradmin'];
            $pass=$_POST['passadmin'];            
            $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $query=$con->query("INSERT INTO admin (user, pass) VALUES ('$user','$pass')");
            $_SESSION['reset']="true";
            echo "<script> parent.window.location.reload(); </script>";
	    mysqli_kill($cona, mysqli_thread_id($cona));
	    mysqli_close($cona);
            }
}
unset($_SESSION['confcode']);
?>