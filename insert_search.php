<?php
include('./functions.php');

$link=createDatabaseConnection();
$searchname = mysqli_real_escape_string($link, $_REQUEST['search_name']);
$sql = "INSERT INTO searches (name)
VALUES ('$searchname')";
 mysqli_query($link,$sql);

?>
