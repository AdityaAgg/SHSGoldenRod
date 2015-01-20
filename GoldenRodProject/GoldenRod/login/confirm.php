<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<?php
/*****************************************************
* New user confirmation page. Should only get here *
* from an email link. *
*****************************************************/
include("dbcontroller.php");
require_once("constants.php");

if((isset($_GET['hash']))&&(isset($_GET['email']))){
$dbcontroller = new DBController();
$worked = $dbcontroller->user_confirm($_GET['email'],$_GET['hash']);
$confirm = '';
$noconfirm = '';
	
if ($worked != 1) {
	$noconfirm = '<div class="terms"> Something went wrong. ' .
	'  If you went' .
	'through to this page directly, please go to login.php ' .
	'instead.</div>';
} 
else 
{
	$confirm = '<div class="terms"> '.
       ' You are confirmed. <a ' .
	'href="../../index.php">Log in</a> to start browsing the ' .
	'site.</div>';
	

	

}

$page = <<< EOPAGE

$noconfirm
$confirm
$t

EOPAGE;
echo '<br>';
echo $page;
unset($dbcontroller);
}
else
header("Location: ../../index.php");
?>