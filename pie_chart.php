<?php
session_start();   
include 'header.php';
include('./functions.php');
 $con= createDatabaseConnection();
 $chartType=mysqli_real_escape_string($con, $_REQUEST['chart_types']);
 $dataCategory=mysqli_real_escape_string($con, $_REQUEST['data_categories']);
 //$countr=mysqli_real_escape_string($con, $_REQUEST['countries']);
 $countries=array();
 foreach ($_POST["countries"] as $country) {
     array_push($countries,$country);
 }
 //echo $countries[0];

?>
<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
 <title>Google Charts</title>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 var chartType="<?php echo $chartType ?>";
 var dataCategory="<?php echo $dataCategory ?>";
 function drawChart() {

 var data = google.visualization.arrayToDataTable([
 
 //metavlites apo to request


 ['name',dataCategory],
 <?php 
 
        $length=sizeof($countries);
        //echo $length;
       // echo $countries[0];
            $query = "SELECT * from countries WHERE ";
           // echo $countries[1];
            for($x=0;$x<$length;$x++)
            {
              if($x==$length-1){
                $query.=" name='$countries[$x]'";
              }
              else{
                $query.=" name='$countries[$x]' OR";
              }
               

             }
             //echo 'ppapapapa'.$query;
        
            
            

       $exec = mysqli_query($con,$query);
       if (!$exec) {
        die('Invalid query: ' . mysql_error());
    }
			 while($row = mysqli_fetch_array($exec)){
 
			 echo "['".$row['name']."',".$row["$dataCategory"]."],";
			 }
			 ?> 
 
 ]);
 
 var options = {
 title: 'Countries chart based on:'+dataCategory,
  pieHole: 0.5,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
 };



 if(chartType=="pie_chart"){
 var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
 chart.draw(data,options);
 }
 else if(chartType=="bar_chart"){
    var chart = new google.visualization.BarChart(document.getElementById("columnchart12"));
 chart.draw(data,options); 
 }
 else if(chartType=="column_chart"){
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart12"));
 chart.draw(data,options); 
 }
 }
 
	
    </script>
 
</head>
<body>
 <div class="container-fluid">
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>
 </div>
 
</body>
</html>