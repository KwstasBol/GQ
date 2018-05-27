

<?php 
session_start();
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
    <form action="./insert_search.php" method="post" autocomplete="off">
    <input id="search_input" name="search_name" type="text">
    <button>Αναζήτηση</button>
    <div id="result"> 
    
    
    </div>

    </form>
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

</script>
</html>
    
  <?php } ?>





