<?php
 include('./functions.php');
 $link=createDatabaseConnection();
 $flag = mysqli_real_escape_string($link, $_REQUEST['flag']);
 $capital = mysqli_real_escape_string($link, $_REQUEST['capital']);
 $area = mysqli_real_escape_string($link, $_REQUEST['area']);
 $population = mysqli_real_escape_string($link, $_REQUEST['population']);
 $gdp = mysqli_real_escape_string($link, $_REQUEST['gdp']);
 $hdi = mysqli_real_escape_string($link, $_REQUEST['hdi']);
 $gini = mysqli_real_escape_string($link, $_REQUEST['gini']);
 //$capital= mysqli_real_escape_string($link, $_REQUEST['country_data[1]']);
 $sql = "INSERT INTO countries (flag,capital,area,population,gdp,hdi,gini) VALUES ('$flag','$capital','$area','$population','$gdp','$hdi','$gini')";
 if(countryExists($capital)==false){
    mysqli_query($link,$sql);
 }
else{
    header("Location: http://localhost/GeogQuest/search.php"); /* Redirect browser */
    exit();
}

 

?>