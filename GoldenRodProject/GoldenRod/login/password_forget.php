<?
class resetController {
private $start;
public function __construct() {
    $start=true;
}
public function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
}





session_start();
if (isset($_SESSION['sent'])) {
    $email2=$_SESSION['sent'];
        
if ($_POST['confcode']==$_SESSION['confcode']) {
    $_SESSION['confcode']="NULL";
	include ("php/constants.php");
	$con= new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$query=$con->query("UPDATE users SET password='saratogafalcons', usr_is_confirmed='0' WHERE email='$email2'");
	mysqli_kill($con, mysqli_thread_id($con));
	mysqli_close($con);
	echo '
	 <link rel="stylesheet" type="text/css" href="../css/styles.css" />
	<br> <br><p> Your account has been reset to the default password:saratogafalcons. Login and you will have the option to change it. <a class="linker" href="php/logout.php"> Back </a> </p>
	<br>';
} else {
     ?>
	<head>
		
		<title>Golden Rod</title>
		<link rel="stylesheet" href="../css/styles.css" />
		<script src="../js/jquery-1.2.3.pack.js"></script>
       
        <script type="text/javascript" language="javascript" src="../js/jquery-1.3.2.js"></script>

    </head>
    
    <body>

        
        <h1> Reset Account </h1>
        <br>
        <br>
        <p> Congrats, a confirmation code has been sent to your email. Enter the code from your email.</p>
        <br>
            <form method="post" action="password_forget.php" class="editaccount"> 
    <label for="confcode" id="confcode_label">Confirmation Code:</label>
		<input class="text-input" style="width: 140px" type="text" id="confcode" name="confcode"/>
                <br>
                    <?
                    if(isset($_POST['confcode']))
                echo '<div class="errorimg"> Confirmation code does not match. </div>';
                ?>
    <br>
        <br>
            <br>
            <input type="submit"  name="sender" class="button" value="Send" />
	    <a style="float: right; margin-right:15px;" class="button" href="php/logout.php"> Back </a>
            </form>
       <?     

}  
}
else {
$controller=new resetController();
$message=$controller->generateRandomString();



$_SESSION['confcode']=$message;


?>

   <?php
		if (isset($_POST['sub'])) {
		   $email=$_POST['email'];		   
		    $messagefull="Your code to reset account information: ".$message;
		    $_SESSION['sent']=$_POST['email'];
		    mail($_POST['email'],"Golden Rod Reset No Reply",$messagefull);
		    echo "<script>  parent.window.location.reload(); </script>";
		}
		?>
		
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
    <head>
        <title>Golden Rod</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" type="text/css" href="../css/styles.css" />
            <script type="text/javascript" language="javascript" src="javascript/jquery-1.3.2.js"></script>
            <script type="text/javascript" language="javascript" src="javascript/register/passwprocess.js"></script>
    </head>
    <body>
     
			
            <h1 style="text-align:center">Reset Account</h1>
        
              
                <form action="password_forget.php" method="post" class="editaccount">
		      Type your email. You'll receive a confirmation code letting you reset your password:
                    <label>Email:</label>
                    <input class="text-input" type="text" id="email" name="email" style="width: 140px" value=""/>
		    <br>
		    <button class="button" name="sub">Submit</button>
		    <div style="float: right; margin-right: 10px" ><a class="button" href="php/logout.php">Back</a></div>
		    
                          
                </form>
             
	    
            
      
        
    </body>
</html>
<?
}
?>
