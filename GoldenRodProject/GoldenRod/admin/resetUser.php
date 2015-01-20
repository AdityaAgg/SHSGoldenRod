<?
    include('../login/php/constants.php');
    session_start();
//send to reset page    
    if(isset($_POST['confcode'])) {
	if ($_POST['confcode']==$_SESSION['confcode']) {
	    $_SESSION['confcode']="NULL";
	    header("Location:resetadmin.php");
	    exit;
	}
    }
    
//Generate RandomString
    function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
	    $randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
    }

    
//store randomstring     
    $message=generateRandomString(14);
    $messagefull="Your code to reset admin account information: ".$message;

//send mail and store random string in session
    if(!(isset($_POST['confcode']))) {
	$_SESSION['confcode']=$message;
	mail(LIBRARY_EMAIL,"Admin Golden Rod Reset No Reply",$messagefull);
    }
?>

<!--Front end-->    
    
    <head>
		
	<title>Golden Rod</title>
	<link rel="stylesheet" href="../css/styles.css" />
    </head>
    
    <body>    
        <h1> Reset Admin Account </h1>
        <br>
        <br>
        
	<p> Congrats, an email has been sent to the admin for your confirmation code. Enter the code from your email.</p>
        
	<br>
        <form method="post" action="resetUser.php" class="editaccount"> 
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
	    <a style="float: right; margin-right:15px;" class="button" href="resetadmin.php"> Back </a>
        </form>
    </body>        
            
            