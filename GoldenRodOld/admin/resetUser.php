<?




class adminController {
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
if(isset($_POST['confcode'])) {
if ($_POST['confcode']==$_SESSION['confcode']) {
    $_SESSION['confcode']="NULL";
    header("Location:resetadmin.php");
exit;
}
}

$controller=new adminController();
$message=$controller->generateRandomString();



$_SESSION['confcode']=$message;


$messagefull="Your code to reset admin account information: ".$message;
if(!(isset($_POST['confcode']))) {
mail("kheyman@lgsuhsd.org","Admin Golden Rod Reset No Reply",$messagefull);
}

?>
    
    
	<head>
		
		<title>Golden Rod</title>
		<link rel="stylesheet" href="../css/styles.css" />
		<script src="../js/jquery-1.2.3.pack.js"></script>
       
        <script type="text/javascript" language="javascript" src="../js/jquery-1.3.2.js"></script>

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
	    <a style="float: right; margin-right:15px;" class="button" href="adminlogin.php"> Back </a>
            </form>
            
            
            