
<?php
//include('./ml_lib/');
session_start();
include('./functions.php');
include 'header.php';
//require('kmeans.php');
//require_once __DIR__ . '/vendor/autoload.php';
require_once  'C:\Users\alex\vendor\autoload.php';
use Phpml\Clustering\KMeans;
$link=createDatabaseConnection();
$sql = "SELECT DISTINCT name,latitude,longitude FROM countries ";

//na arxizei mono
$_SESSION['centroidsA']=array();
$_SESSION['centroidsB']=array();
$result=mysqli_query($link,$sql);
$allCountries=array();
$samples=array();
$output='';
    if (mysqli_num_rows($result)!=0) {
        while($row = mysqli_fetch_assoc($result)){
            $allCountries[]=$row;

        }
        foreach($allCountries as $row){
            //$output.='<h4>'.$row["name"].$row["latitude"].$row["longitude"].'</h4>';
            //array_push($samples,[$row["latitude"],$row["longitude"]]);
            
            
        }   
      //ETOIMO ME PHP ALLA OK...
      //print_r($samples[0][1]);
    //   $kmeans=new KMeans(2,);
    //   $k=$kmeans->cluster($samples);
    //   print_r($samples);
    //   print_r('------------------------');
    //   print_r($k);

    //DIKO MAS IMPLEMENTATION

    //1.epilogh tuxaiou kedrou ths 1hs omadas
   // print_r($allCountries[0]['latitude']);
    $countriesSize=sizeof($allCountries);
    //echo $countriesSize;
    $firstRandom=rand(0,$countriesSize-1);
    $secondRandom=rand(0,$countriesSize-1);
    while($secondRandom==$firstRandom ){
        $secondRandom=rand(0,$countriesSize-1);
    }
    //echo ('<br>----RANDOM NUMBERS:'.$firstRandom.'---'.$secondRandom);
    $firstCentroid=$allCountries[$firstRandom];
    //unset($allCountries[$firstRandom]);
   // print_r("<br>FIRST CENTROID:". $firstCentroid['latitude']);
    //2.epilogh tuxaiou kedrou ths 2hs omadas
    $secondCentroid=$allCountries[$secondRandom];
    array_push($_SESSION['centroidsA'],$firstCentroid);
    array_push($_SESSION['centroidsB'],$secondCentroid);
    //unset($allCountries[$secondRandom]);
    //print_r("<br>SECOND CENTROID:". $secondCentroid['latitude']);
    //print_r($allCountries);
   // echo $countriesSize;
    //3.Anathesh se omades A,B
    // print_r($firstCentroid);
    // print_r($secondCentroid);
    $teamA=array();
    array_push($teamA,$firstCentroid);
    $teamB=array();
    array_push($teamB,$secondCentroid);
    $teamA1=array();
    $teamB1=array();
    $teamA2=array();
    $teamB2=array();
    $teamA3=array();
    $teamB3=array();
    $teamA4=array();
    $teamB4=array();
    
    for($x=0;$x<5;$x++){
        
        for($z=0;$z<$countriesSize;$z++){
            $distanceA='';
       $distanceB='';
          if($x==0){
            if(($allCountries[$z]['latitude']==$firstCentroid['latitude']) ||($allCountries[$z]['latitude']==$secondCentroid['latitude']) ){
                continue;
            }}
            for($c=0;$c<2;$c++){
                if($c==0){
                    $distanceA=sqrt(pow(($allCountries[$z]['latitude']-$firstCentroid['latitude']),2)+pow(($allCountries[$z]['longitude']-$firstCentroid['longitude']),2));

                }else{
                    $distanceB=sqrt(pow(($allCountries[$z]['latitude']-$secondCentroid['latitude']),2)+pow(($allCountries[$z]['longitude']-$secondCentroid['longitude']),2));
                }
               
            }
            if($distanceA>$distanceB){
                if($x==0){
                    array_push($teamB,$allCountries[$z]);
                }
                else if($x==1){
                    array_push($teamB1,$allCountries[$z]);
                }
                else if($x==2){
                    array_push($teamB2,$allCountries[$z]);
                }
                else if($x==3){
                    array_push($teamB3,$allCountries[$z]);
                }
                else if($x==4){
                    array_push($teamB4,$allCountries[$z]);
                }
                
            }
            else{
                if($x==0){
                    array_push($teamA,$allCountries[$z]);
                }
                else if($x==1){
                    array_push($teamA1,$allCountries[$z]);
                }
                else if($x==2){
                    array_push($teamA2,$allCountries[$z]);
                }
                else if($x==3){
                    array_push($teamA3,$allCountries[$z]);
                }
                else if($x==4){
                    array_push($teamA4,$allCountries[$z]);
                }
            }
        }

        
       $sizeA=sizeof($teamA);
       $sizeB=sizeof($teamB);
       $sumofLat=0;
       $sumofLong=0;
       $sumofLatB=0;
       $sumofLongB=0;
    //    $firstCentroid['latitude']=0;
    //    $firstCentroid['longitude']=0;
    //    $secondCentroid['latitude']=0;
    //    $secondCentroid['longitude']=0;
    //    echo('<br>SIZE OF TEAM A:'.$sizeA);
    //    echo('<br>SIZE OF TEAM B:'.$sizeB);
    //    echo('NEW FIRST CENTROID:<br>');
    //    print_r($firstCentroid);

    if($x==0){

        foreach($teamA as $row){
            $sumofLat+=$row['latitude'];
            $sumofLong+=$row['longitude'];
         
         
         
     } 
     
     foreach($teamB as $row){
         $sumofLatB+=$row['latitude'];
         $sumofLongB+=$row['longitude'];
      
      
      
  } 
   
    //first center
    $firstCentroid['name']='Centroid A';
    $firstCentroid['latitude']= $sumofLat/$sizeA;
    $firstCentroid['longitude']=$sumofLong/$sizeA;
    array_push($_SESSION['centroidsA'],$firstCentroid);
    array_push($_SESSION['centroidsB'],$secondCentroid);
    // echo $sumofLat/$sizeA;
    // echo '<br>'.$sumofLong/$sizeA.'<br>';
    // print_r($firstCentroid);
    // echo '<br> TEAM A <br>';
    // print_r($teamA);

    // echo '<br> TEAM B <br>';
    // print_r($teamB);

    //second center
    $secondCentroid['name']='Centroid B';
    $secondCentroid['latitude']= $sumofLatB/$sizeB;
    $secondCentroid['longitude']=$sumofLongB/$sizeB;
    // echo $sumofLatB/$sizeB;
    // echo '<br>'.$sumofLongB/$sizeB.'<br>';
    // print_r($secondCentroid);
    }


    if($x==1){

        foreach($teamA1 as $row){
            $sumofLat+=$row['latitude'];
            $sumofLong+=$row['longitude'];
         
         
         
     } 
     
     foreach($teamB1 as $row){
         $sumofLatB+=$row['latitude'];
         $sumofLongB+=$row['longitude'];
      
      
      
  } 
   
    //first center
    $firstCentroid['name']='Centroid A';
    $firstCentroid['latitude']= $sumofLat/sizeof($teamA1);
    $firstCentroid['longitude']=$sumofLong/sizeof($teamA1);
    // echo $sumofLat/$sizeA;
    // echo '<br>'.$sumofLong/$sizeA.'<br>';
    // print_r($firstCentroid);
    // echo '<br> TEAM A <br>';
    // print_r($teamA1);

    // echo '<br> TEAM B <br>';
    // print_r($teamB1);

    //second center
    $secondCentroid['name']='Centroid B';
    $secondCentroid['latitude']= $sumofLatB/sizeof($teamB1);
    $secondCentroid['longitude']=$sumofLongB/sizeof($teamB1);

    array_push($_SESSION['centroidsA'],$firstCentroid);
    array_push($_SESSION['centroidsB'],$secondCentroid);
    // echo $sumofLatB/$sizeB;
    // echo '<br>'.$sumofLongB/$sizeB.'<br>';
    // print_r($secondCentroid);
    }
 
    if($x==2){

        foreach($teamA2 as $row){
            $sumofLat+=$row['latitude'];
            $sumofLong+=$row['longitude'];
         
         
         
     } 
     
     foreach($teamB2 as $row){
         $sumofLatB+=$row['latitude'];
         $sumofLongB+=$row['longitude'];
      
      
      
  } 
   
    //first center
    $firstCentroid['name']='Centroid A';
    $firstCentroid['latitude']= $sumofLat/sizeof($teamA2);
    $firstCentroid['longitude']=$sumofLong/sizeof($teamA2);
    // echo $sumofLat/$sizeA;
    // echo '<br>'.$sumofLong/$sizeA.'<br>';
    // print_r($firstCentroid);
    // echo '<br> TEAM A <br>';
    // print_r($teamA2);

    // echo '<br> TEAM B <br>';
    // print_r($teamB2);

    //second center
    $secondCentroid['name']='Centroid B';
    $secondCentroid['latitude']= $sumofLatB/sizeof($teamB2);
    $secondCentroid['longitude']=$sumofLongB/sizeof($teamB2);
    array_push($_SESSION['centroidsA'],$firstCentroid);
    array_push($_SESSION['centroidsB'],$secondCentroid);
    // echo $sumofLatB/$sizeB;
    // echo '<br>'.$sumofLongB/$sizeB.'<br>';
    // print_r($secondCentroid);
    }
     
    if($x==3){

        foreach($teamA3 as $row){
            $sumofLat+=$row['latitude'];
            $sumofLong+=$row['longitude'];
         
         
         
     } 
     
     foreach($teamB3 as $row){
         $sumofLatB+=$row['latitude'];
         $sumofLongB+=$row['longitude'];
      
      
      
  } 
   
    //first center
    $firstCentroid['name']='Centroid A';
    $firstCentroid['latitude']= $sumofLat/sizeof($teamA3);
    $firstCentroid['longitude']=$sumofLong/sizeof($teamA3);
    // echo $sumofLat/$sizeA;
    // echo '<br>'.$sumofLong/$sizeA.'<br>';
    // print_r($firstCentroid);
    // echo '<br> TEAM A <br>';
    // print_r($teamA3);

    // echo '<br> TEAM B <br>';
    // print_r($teamB3);

    //second center
    $secondCentroid['name']='Centroid B';
    $secondCentroid['latitude']= $sumofLatB/sizeof($teamB3);
    $secondCentroid['longitude']=$sumofLongB/sizeof($teamB3);
    array_push($_SESSION['centroidsA'],$firstCentroid);
    array_push($_SESSION['centroidsB'],$secondCentroid);
    // echo $sumofLatB/$sizeB;
    // echo '<br>'.$sumofLongB/$sizeB.'<br>';
    // print_r($secondCentroid);
    }
    if($x==4){

        foreach($teamA4 as $row){
            $sumofLat+=$row['latitude'];
            $sumofLong+=$row['longitude'];
         
         
         
     } 
     
     foreach($teamB4 as $row){
         $sumofLatB+=$row['latitude'];
         $sumofLongB+=$row['longitude'];
      
      
      
  } 
   
    //first center
    $firstCentroid['name']='Centroid A';
    $firstCentroid['latitude']= $sumofLat/sizeof($teamA4);
    $firstCentroid['longitude']=$sumofLong/sizeof($teamA4);
    // echo $sumofLat/$sizeA;
    // echo '<br>'.$sumofLong/$sizeA.'<br>';
    // print_r($firstCentroid);
    // echo '<br> TEAM A4 <br>';
    // print_r($teamA4);

    // echo '<br> TEAM B4 <br>';
    // print_r($teamB4);

    //second center
    $secondCentroid['name']='Centroid B';
    $secondCentroid['latitude']= $sumofLatB/sizeof($teamB4);
    $secondCentroid['longitude']=$sumofLongB/sizeof($teamB4);
    array_push($_SESSION['centroidsA'],$firstCentroid);
    array_push($_SESSION['centroidsB'],$secondCentroid);
    // echo $sumofLatB/$sizeB;
    // echo '<br>'.$sumofLongB/$sizeB.'<br>';
    // print_r($secondCentroid);
    }
    // echo '<br> EPANALHPSH '.$x.'<br>';
   
   


        // $firstCentroid=
        // // $secondCentroid=
        // unset($teamA);
        // $teamA=array();
        // unset($teamB);
        // $teamB=array();
    }
//   echo '<br> TEAM A<br>';

//     print_r($teamA);
//     echo '<br> TEAM B<br>';
//     print_r ($teamB);

    



    }

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart','map'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
    google.charts.setOnLoadCallback(drawCentroidsMap);
      google.charts.setOnLoadCallback(drawRegionsMap);
      var step=0;
      var teamA=<?php  echo json_encode($teamA) ?>;
      var teamB=<?php echo json_encode($teamB)?>;
      var teamA1=<?php echo json_encode($teamA1)?>;
      var teamB1=<?php echo json_encode($teamB1)?>;
      var teamA2=<?php echo json_encode($teamA2)?>;
      var teamB2=<?php echo json_encode($teamB2)?>;
      var teamA3=<?php echo json_encode($teamA3)?>;
      var teamB3=<?php echo json_encode($teamB3)?>;
      var teamA4=<?php echo json_encode($teamA4)?>;
      var teamB4=<?php echo json_encode($teamB4)?>;
      var centroidsA=<?php echo  json_encode($_SESSION['centroidsA']); ?>;
      var centroidsB=<?php echo  json_encode($_SESSION['centroidsB']); ?>;
    //   console.log(teamA[0].name);
    //   console.log(teamA);
    //   console.log(teamA1);
    //   console.log(teamA2);
    console.log(centroidsA);
    console.log(centroidsB);
 
    function drawCentroidsMap() {
      var data =  new  google.visualization.DataTable();
        
      data.addColumn('number', 'Place');
    data.addColumn('number', 'Team'); 
    //console.log(]);
    if(step==0){
    data.addRow([Number(String(centroidsA[0]['latitude'])),Number(String(centroidsA[0]['longitude']))]);
    data.addRow([Number(String(centroidsB[0]['latitude'])),Number(String(centroidsB[0]['longitude']))]);
    }
    else if(step==1){
    data.addRow([Number(String(centroidsA[1]['latitude']).substr(0,5)),Number(String(centroidsA[1]['longitude']).substr(0,5))]);
    data.addRow([Number(String(centroidsB[1]['latitude']).substr(0,5)),Number(String(centroidsB[1]['longitude']).substr(0,5))]);
    }
    else if(step==2){
    data.addRow([Number(String(centroidsA[2]['latitude']).substr(0,5)),Number(String(centroidsA[2]['longitude']).substr(0,5))]);
    data.addRow([Number(String(centroidsB[2]['latitude']).substr(0,5)),Number(String(centroidsB[2]['longitude']).substr(0,5))]);
    }
    else if(step==3){
    data.addRow([Number(String(centroidsA[3]['latitude']).substr(0,5)),Number(String(centroidsA[3]['longitude']).substr(0,5))]);
    data.addRow([Number(String(centroidsB[3]['latitude']).substr(0,5)),Number(String(centroidsB[3]['longitude']).substr(0,5))]);
    }
    else if(step==4){
    data.addRow([Number(String(centroidsA[4]['latitude']).substr(0,5)),Number(String(centroidsA[4]['longitude']).substr(0,5))]);
    data.addRow([Number(String(centroidsB[4]['latitude']).substr(0,5)),Number(String(centroidsB[4]['longitude']).substr(0,5))]);
    }
    //data.addRow([centroidsA[0].latitude,centroidsA[0].longitude])
    //data.addRow([String(centroidsB[0].latitude),String(centroidsB[0].longitude)]);
            
     // console.log(centroidsA);
      var map = new google.visualization.Map(document.getElementById('chart_div'));
        map.draw(data, {showTooltip: true,
      showInfoWindow: true});
      
      }
    

      function drawRegionsMap() {
        var data = new  google.visualization.DataTable();
        
        
            data.addColumn('string', 'Country');
            data.addColumn('number', 'Team'); 
            if(step==0)  {
            teamA.forEach(function(row){
                data.addRow([row.name,0]);
                
            });
            teamB.forEach(function(row){
                data.addRow([row.name,1]);
            });
            }
            else if(step==1){
                teamA1.forEach(function(row){
                data.addRow([row.name,0]);
            });
            teamB1.forEach(function(row){
                data.addRow([row.name,1]);
            });

            }
            else if(step==2){
                teamA2.forEach(function(row){
                data.addRow([row.name,0]);
            });
            teamB2.forEach(function(row){
                data.addRow([row.name,1]);
            });

            }
            else if(step==3){
                teamA3.forEach(function(row){
                data.addRow([row.name,0]);
            });
            teamB3.forEach(function(row){
                data.addRow([row.name,1]);
            });

            }
            else if(step==4){
                teamA4.forEach(function(row){
                data.addRow([row.name,0]);
            });
            teamB4.forEach(function(row){
                data.addRow([row.name,1]);
            });

            }
        var options = {
            displayMode: 'regions',
            colorAxis: {colors: ['green', 'red']}
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
       

        chart.draw(data, options);


      }

    
    </script>
  </head>
  <body>
      
      <button id="next" class="uk-button-Primary uk-button-small ">Next</button>
      
    <div >
    <div id="regions_div" style="width: 48%; height: 500px;display:inline-block"></div>
    <div id="chart_div"  style="width: 48%; height: 500px;display:inline-block"></div>
    </div>
    


    <script>
      $('#next').click(function(){
               if(step<4){
                 ++step;
                 
                console.log(step);
              
                drawRegionsMap();
                drawCentroidsMap();
                }
                else{
                    $('#next').prop('disabled',true);
                }
      });
    </script>
  </body>
</html>