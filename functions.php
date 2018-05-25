<?php


function checkPassword($pass){

    $two_capitals=preg_match("^(.*?[A-Z]){2,}^",$pass);
    $two_numbers=preg_match("^(.*?[A-Z]){2,}^",$pass);
    $one_special=preg_match("^(.*?[\W]){1,}^",$pass);
    $length=strlen($pass);
    if ($two_capitals && $two_numbers && $one_special && $length>=6 &&$length<=8){
    
        return true;
    }
    else{
        return false;
    }

}

function createDatabaseConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "geoquest";


    // Create connection
    $link= new mysqli($servername, $username, $password, $dbname);
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    return $link;
    // Check connection
}

function userExists($una){
    $link=createDatabaseConnection();
    $sql = "SELECT username from Users where username='$una' ";
    $result=mysqli_query($link, $sql);
    $data = mysqli_fetch_array($result,MYSQLI_NUM);
    if ($data[0] > 1) {
        return true;
    }
    else {
        return false;
    }


}
function validateLogin($una,$pass){
    $link=createDatabaseConnection();
    $sql = "SELECT * from Users where username='$una' ";
    $result=mysqli_query($link, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($hashed, $row['password'])) {
            return true;
        }
        else{
            return falase;
        }
    }
 

}
?>