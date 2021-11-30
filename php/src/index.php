<?php session_start();
    include('server.php');
    
    if(isset($_SESSION['nickname'])){
        echo "Hi " . $_SESSION['nickname'] . "!! You are now logged in";
    }   
    echo $_GET['logout'];
    if(isset($_GET['logout'])){
        if($_GET['logout']){
            session_destroy();
        }
    }  
    
?>
<!DOCTYPE html>
    <head>
      <title>Registration system PHP and MySQL</title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="header">
            <h2>Taste and Purchase Events</h2>
        </div>
        <form>
            <div class="input-group">
                <input type=button onClick="location.href='register.php'" value='Sign Up'>
            </div>
            <div class="input-group">
                <input type=button onClick="location.href='login.php'" value='Sign in'>
            </div>
            <?php if(isset($_SESSION['nickname'])){ ?>
            <div class="input-group">
                <input type=button onClick="location.href='Logout.php'" value='Sign out'>
            </div>
            <?php } ?>
        </form>
    </body>