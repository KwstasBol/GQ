<?php

include('./functions.php');
$link=createDatabaseConnection();
$output='';
//$sql = "SELECT name FROM searches  WHERE name LIKE '%".$_POST["search"]."%'";
//na arxizei mono
$result=mysqli_query($link,$sql);
$allRows=array();

    if (mysqli_num_rows($result)!=0) {
        while($row = mysqli_fetch_assoc($result)){
            $allRows[]=$row;

        }
        foreach($allRows as $row){
            $output.='
            <h4>'.$row["name"].'</h4>
        
        ';
        }
       
    
    echo $output;
}
else{
    echo ('No results');
}




?>