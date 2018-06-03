     

     <?php
        include 'header.php';
     ?>
     <div class=".uk-text-small">

        <h1 >Create Your Account</h1>
        </div>
    <form class="uk-form-width-Medium" action="./insert_user.php" method="post">
    <div>
    <label for="username">Username</label>
    <input class="uk-input" type="text" name="username">
    </div>
    <div>
    <label for="email">E-mail</label>
    <input class="uk-input" type="email" name="email">
    </div>
    <div>
    <label for="password">Password</label>
    <input class="uk-input" type="password" name="password">
       </div>
    <div>
    <br>

    <input class="uk-button-Primary uk-button-small" type="submit"> 
    </br>
    </div>
 
  
  

    </form>