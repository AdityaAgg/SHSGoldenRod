<? session_start();
session_unset($_SESSION['pk_user']);
session_destroy();
header("Location: http://appdevclubshs.com/GoldenRod/index.php");


?>