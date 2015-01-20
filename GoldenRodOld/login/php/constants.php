<?php
define("DB_SERVER", "68.178.142.118 ");
define("DB_USER", "goldener");
define("DB_PASS", "Orionx2001@");
define("DB_NAME", "goldener");

/**
 * Cookie Constants - these are the parameters
 * to the setcookie function call, change them
 * if necessary to fit your website. If you need
 * help, visit www.php.net for more info.
 * <http://www.php.net/manual/en/function.setcookie.php>
 */
define("GUEST_NAME", "Guest");
define("COOKIE_EXPIRE", 60*60*24*100);  //100 days by default
define("COOKIE_PATH", "/");  //Avaible in whole domain
/**
 * Email Constants - these specify what goes in
 * the from field in the emails that the script
 * sends to users, and whether to send a
 * welcome email to newly registered users.
 */
define("EMAIL_FROM_NAME", "Mark Test1");
define("EMAIL_FROM_ADDR", "marktest1@68.178.142.118");
/**
 * This constant forces all users to have
 * lowercase usernames, capital letters are
 * converted automatically.
 */
define("ALL_LOWERCASE", false);

/**
 *For hashing purposes  
 **/
define("supersecret_hash_padding",'String used to pad out small strings for a sha1 encryption');
define("supersecret_hash_padding_2",'Other String used to pad out small strings for a sha1 encryption');

/**
 *If you want that the user has to repeat the E-Mail and/or the Password
 *in the registration form , set the following to true or false  
 **/
define("REPEAT_EMAIL",true);
define("REPEAT_PASSWORD",true);


/*
 * the link on your server to the file resetpassword.php and confirm.php
 * these are gonna be used in the mail body 
 * */
define("RESETPASSWORDLINK","appdevclubshs.com/GoldenRod/login/resetpassword.php");
define("CONFIRMACCOUNTLINK","appdevclubshs.com/GoldenRod/login/php/confirm.php");

/*
 * recaptcha keys:
 * */
?>