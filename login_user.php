<?php
//session_start();
include('./functions.php');
$link=createDatabaseConnection();
$uname = mysqli_real_escape_string($link, $_REQUEST['username']);
$pass =  mysqli_real_escape_string($link, $_REQUEST['password']);
//$hashed=hash('sha256',$pass);
//$hashed=password_hash($pass,PASSWORD_DEFAULT);
if(validateLogin($uname,$pass)==true){
  
    $_SESSION['login_user']= $uname;
    header("Location: http://localhost/GeogQuest/search.php"); /* Redirect browser */
    exit();
}
else{
    header("Location: http://localhost/GeogQuest/login.php"); /* Redirect browser */
    exit();
}
?>