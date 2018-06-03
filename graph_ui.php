
<?php 

session_start();
include 'header.php';
include('./functions.php');
$link=createDatabaseConnection();
$sql = "SELECT DISTINCT name FROM countries  ";
//na arxizei mono
$result=mysqli_query($link,$sql);
$output='';
$allRows=array();

if(isset($_SESSION['login_user'])){
    echo ('
    
    <form  action="./pie_chart.php" method="POST">
    <h4>Choose countries</h4>
    <div>
    ');
    if (mysqli_num_rows($result)!=0) {
        while($row = mysqli_fetch_assoc($result)){
            $allRows[]=$row;

        }
        foreach($allRows as $row){
            
            $output.= '
            <div><input  name="countries[]"  value='.$row["name"].' type="checkbox" >'.$row["name"].'</input></div>
            
            ' ;
        }
        $output.='
        </div> <br>

        <div class="uk-width-medium">
            <h4>Choose Search Criteria</h4>
    <select class="uk-select"  name="data_categories">
      <option value="area">Area</option>
      <option value="population">Population</option>
      <option value="gdp">GDP</option>
      <option value="hdi">HDI</option>
      <option value="gini">GINI</option>
    </select>
        </div>
    
        <div>
            <br>
        </div>
    <div class="uk-width-medium">
    <h4>Choose Chart</h4>
    <select class ="uk-select" name="chart_types" id="chart_types" >
      <option value="pie_chart">Pie Chart</option>
      <option value="bar_chart">Bar Chart</option>
      <option value="column_chart">Column Chart</option>
    </select>
    
    <br>
    
   
    <button class="uk-button-Primary uk-button-small" id="show">Show</button>
    </form>
    
    </div>';
        echo $output;
      
    }

}
else{
    echo '<h2>You must login in order to see the charts</h2>';
}

 { ?>
<html>





<head> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 

</head>



<body>
   






</body>

</html>



<?php } ?>