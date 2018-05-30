<?php
 include('./functions.php');
 $x = $_REQUEST['search_name'];
 $country_check=false;
 $data=NULL;
 $link=createDatabaseConnection();
 $searchname = mysqli_real_escape_string($link, $x);
 $sql = "INSERT INTO searches (name) VALUES ('$searchname')";
 mysqli_query($link,$sql);

 

?>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <h1>
    <?php
       echo $searchname
    ?>
    </h1>
   
<div id="kati"></div>
    <script>
        // $.ajax({
        //     type: "GET",
        //     url: "http://en.wikipedia.org/w/api.php?action=parse&format=json&page=<?php echo $searchname?>&redirects&prop=text&callback=?",
        //     contentType: "application/json; charset=utf-8",
        //     async: false,
        //     dataType: "json",
        //     success: function (data) {
        //         console.log(data.parse.pageid);
        //         $('#kati').html(data.parse.pageid);
        //     },
        //     error: function (errorMessage) {
                
        //     }

        // });

    </script>
</body>
</html>


