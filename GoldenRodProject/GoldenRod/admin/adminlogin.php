<?php session_start();
//database connect
include ("../login/php/constants.php");

//automatic by session login
if ($_SESSION['works']=="true") {
    header ('Location: admin.php');
}


//first login
if (isset($_POST['usernamer'],$_POST['passworder'])) {
	    $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);    
	    $query=$con->query("SELECT*FROM admin");
	    $row=$query->fetch_assoc();	    
	    $passworder=$row['pass'];
	    $usernamer=$row['user'];
	    $_SESSION['posted']="true";
	    if ($_POST['usernamer']==$usernamer && $_POST['passworder']==$passworder) {
		$_SESSION['works']="true";
		header('Location: admin.php');    
	    }
	    mysqli_kill($con, mysqli_thread_id($con));
	    mysqli_close($con);	
	}
?>


<html>
    <head>
        <title>Golden Rod</title>
        <link rel="stylesheet" href="../css/styles.css" />
    </head>
    
    <body>
	

	<br/>
	<br/>
	<br/>
	    <div style="float:right;margin-right:10%;">
			<h1 style="text-align:center">Admin Login</h1> <br/>	
			<form action="adminlogin.php" method="post" class="login"> 			
			    <label name="username_label"> Username: </label>
			    <input type="text" name="usernamer" class="text/input"/>
			    <br>
			    <label name="password_label"> Password: </label>
			    <input type="password"  name="passworder" class="text/input"/>
			    <br>	    
			    <?
			    if(isset($_SESSION['posted'])) {
			    echo '<div class="errorimg"> Wrong Username or Password </div>';
			    unset($_SESSION['posted']);
			    }
			    ?>
			    <br>
			    <p>
				<input type="submit"  class="button" value="Login" style="color:#fff;" />
				<br>
				<br>
				<a href="resetUser.php"> Reset User Information </a>
			    </p>
			</form>
	    </div>	
	<br/>
    </body>
</html>