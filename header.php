


<html>
        

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.2/css/uikit.min.css" />


</head>

<body>

<?php
if(isset($_SESSION['login_user'])) { ?>
    
    <nav class="uk-navbar-container" id="login_navbar" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li id='first' class="uk-active"><a href="./index.php">GeogQuest</a></li>
                <li id='search' class="uk-active"><a href="./search.php">Search</a></li>
                <li id='search' class="uk-active"><a href="./graph_ui.php">CHARTS</a></li>
                <li id='search' class="uk-active"><a href="./kmeans.php">KMEANS</a></li>
                <li id='logout' class="uk-active"><a href="./logout.php">LOGOUT</a></li>

            </ul>
        </div>
    
    </nav>
    
  <?php } 
  else{ ?>

    <nav class="uk-navbar-container" id="logout_navbar" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li id='first' class="uk-active"><a href="./index.php">GeogQuest</a></li>
                <li id='register' class="uk-active"><a href="./register.php">REGISTER</a></li>
                <li id='login' class="uk-active"><a href="./login.php">LOGIN</a></li>

                
            </ul>
        </div>
    
    </nav>
    <?php } ?>

</body>






</html>