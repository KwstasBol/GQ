<?php
include('./functions.php');

$link=createDatabaseConnection();
$uname = mysqli_real_escape_string($link, $_REQUEST['username']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$pass =  mysqli_real_escape_string($link, $_REQUEST['password']);
//$hashed_pass=hash('sha256',$pass);
$hashed_pass=password_hash($pass,PASSWORD_DEFAULT);
$sql = "INSERT INTO Users (username, email, password)
VALUES ('$uname', '$email', '$hashed_pass')";

if(userExists($uname)==false && checkPassword($pass)==true){
   
    mysqli_query($link,$sql);
    header("Location: http://localhost/GeogQuest/login.php"); /* Redirect browser */
    exit();
}
else{

    header("Location: http://localhost/GeogQuest/register.php"); /* Redirect browser */
    exit();
}




mysqli_close($link);
?>
