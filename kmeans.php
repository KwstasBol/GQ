<?php

include('./functions.php');
$link=createDatabaseConnection();
$sql = "SELECT name FROM countries  WHERE name LIKE ";
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



?>






<html>

<head>
<title>KMeans</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    





    <script >

 
    
    </script>
</body>


</html>