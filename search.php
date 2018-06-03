




<?php 
session_start();
include 'header.php';
$country_flag;
$country_capital;
$country_area;
$country_population;
$country_gdp;
$country_hdi;
$country_gini;

if(isset($_SESSION['login_user'])) { ?>

        

<html>
<head>

<title>
    Search
</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>
<body>
<h1>Search for countries...</h1>

    <div class="uk-width-medium">
    <input  class="uk-input-large" id="search_input" name="search_name" type="text">
    </div>
   

    
    <button class="uk-button-Primary uk-button-small" name="subm" id=search_button>Αναζήτηση</button>
    <div id="result"> 
    
    
    </div>

    <table class="uk-table uk-table-striped uk-table-small" name="table" style="display:none"  id="table_id" border="1">
        <tr>
        <td>
          Σημαία (Εικόνα)
        </td>
        <td id="td_flag">
         
        </td>
        </tr>

        <tr>
        <td>
        Όνομα 
        </td>
        <td id="td_name_geo">
        </td>
        </tr>

        <tr>
        <td>
        Έκταση (σε τετραγωνικά χιλιόμετρα)
        </td>
        <td id="td_length">
        </td>
        </tr>

        <tr>
        <td>
        Πληθυσμός
        </td>
        <td id="td_population">
        </td>
        </tr>

        <tr>
        <td>
        GDP per capita
        </td>
        <td id="td_GDP">
        </td>
        </tr>

        <tr>
        <td>
        HDI (Human Development Index)
        </td>
        <td id="td_HDI">
        </td>
        </tr>

        <tr>
        <td>
        Gini Coefficient
        </td>
        <td id="td_Coefficient">
        </td>
        </tr>

    </table>
    <button class="uk-button-Primary uk-button-small" id="add_button" style="display:none">Καταχώρηση</button>
    <button class="uk-button-Primary uk-button-small" id="add_new_country" style="display:none">Νέα Χώρα</button>
       
    <div id="kati"></div>
</body>
<script >
    
        $(document).ready(function(){
        $( "#search_input" ).keyup(function() {
            var text=$(this).val();
            if(text!=''){
                $.ajax({
                      url:'search_search.php',
                      method:'POST',
                      data:{search:text},
                      dataType:"text",
                      success:function(data){
                        
                        $('#result').html(data);
                      }  
                });
            }
            else{
                $('#result').html('');
            }
            });
			});

            $(document).ready(function(){
        $( "#search_button" ).click(function() {
            $('#kati').empty();
            var text=$('#search_input').val();            
            $.ajax({
            type: "GET",
            url: "http://en.wikipedia.org/w/api.php?action=parse&format=json&page="+text+"&redirects&prop=text&callback=?",
            contentType: "application/json; charset=utf-8",
            async: false,
            dataType: "json",
            success: function (data) {
                console.log(data.parse.text);
                console.log(data.parse.pageid);
                //$('#kati').html(data.parse.pageid);
                $('#result').empty();
                $('#table_id').show();
                $('#add_button').show();
                $('#add_new_country').show();
               
                //var data2 = $("<th scope=\"row\">Capital</th>").html();  
                var wikiHTML = data.parse.text["*"];
                var data2 = $("<document>"+wikiHTML+"</document>") ;
                var ajax_image=data2.find('img:nth-child(1)').attr('src');
                var ajax_capital=data2.find('th:contains("Capital")  ').next().find('a').html();
                var ajax_population=(data2.find(' th:contains("estimate") ').next().remove('a').text()).split('['); 
                var ajax_gdp=data2.find('tr:contains("Per capita") td').text().split('[');
                var ajax_gini=data2.find('th:contains("Gini") ').next().text().replace(/<img[^>]*>/g,"").split('[');
                var ajax_hdi=data2.find('th:contains("HDI") ').next().text().replace(/<img[^>]*>/g,"").split('[');

                var ajax_area=data2.find('tr:contains("Total") td   ').text().split('(');
                console.log('COOORDDI'+data2.find('.geo').html());
                var coordinates=data2.find('.geo').html().split(';')
                var latitude=coordinates[0];
                var longitude=coordinates[1];
                console.log(latitude+'-'+longitude);
                
               
               
                console.log('HDI '+ajax_hdi[0].substr(1,5));
                console.log('POPULATION '+ajax_population[0]);
                console.log('GINI '+ajax_gini[0]);
                console.log('GDP '+ajax_gdp[0].substr(1,6));
                console.log('CAPITAL '+ajax_capital);
                console.log('AREA '+ajax_area[0].substr(0,7)  );

                $country_name=data.parse.title;
                $country_flag=ajax_image;
                $country_capital=ajax_capital;
                $country_area=parseFloat(ajax_area[0].substr(0,7).replace(",","."));
                $country_population=ajax_population[0].replace(/,/g, "");
                $country_gdp=ajax_gdp[0].substr(1,10).replace(/,/g, "");
                $country_hdi=ajax_hdi[0].substr(1,5);
                $country_gini=parseFloat(ajax_gini[0]);
                $latitude=latitude;
                $longitude=longitude;
                console.log($country_gini);
                console.log(data.parse.title);
             

                //console.log($country_data);

                $('#td_flag').html('<img src='+ajax_image+'>');
                $('#td_name_geo').html(ajax_capital+'- Lat:'+latitude+',Long:'+longitude);
                $('#td_length').html(ajax_area[0]);
                $('#td_population').html(ajax_population[0]);
                $('#td_GDP').html(ajax_gdp[0]);
                $('#td_HDI').html(ajax_hdi[0]);
                $('#td_Coefficient').html(ajax_gini[0]);
                
                $.ajax({
                      url:'insert_search.php',
                      method:'POST',
                      data:{search_name:text},
                      dataType:"text",
                      success:function(data){
                        
                      }  
                });

            },
            error: function (errorMessage) {
                
            }

        });

            if(text!=''){
                $.ajax({
                      url:'search_search.php',
                      method:'POST',
                      data:{search:text},
                      dataType:"text",
                      success:function(data){
                        
                        $('#result').html(data);
                      }  
                });
            }
            else{
                $('#result').html('');
            }
            });

            $('#add_button').click(function(){
                $.ajax({
                    url:'./insert_country.php',
                    method:'POST',
                    data:{
                    name:$country_name,
                    latitude:$latitude,
                    longitude:$longitude,
                    flag:$country_flag,
                    capital:$country_capital,
                    area:$country_area,
                    population:$country_population,
                    gdp:$country_gdp,
                    hdi:$country_hdi,
                    gini:$country_gini
                    },
                    dataType:"text"
                })
            });
            
            $('#add_new_country').click(function(){
                $.ajax({
                    success: function() {
                         location.reload();
                         $('#table_id').hide();
                             $('#add_button').hide();
                             $('#add_new_country').hide();
                            }
                           
                            
                   
                })
            });
            
			});

</script>  
 
</html>
    
  <?php }  ?>





