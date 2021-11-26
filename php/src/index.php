<?php include('server.php');
    
    //<div class="input-group">
    //    <button>E-mail</label>
    //    <input type="text" name="mail" >
    //</div>
    //<div class="input-group">
    //    <label>Password</label>
    //    <input type="password" name="password">
    //</div>
    //<div class="input-group">
    //    <button type="submit" class="btn" name="login_user">Login</button>
    //</div>
    //<p>
    //    Not yet a member? <a href="register.php">Sign up</a>
    //</p>


    //include 'register.php';
?>
<!DOCTYPE html>
    <head>
      <title>Registration system PHP and MySQL</title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <?php   session_start();
                if(isset($_SESSION['nickname'])){
                    echo "Hi " . $_SESSION['nickname'] . "!! You are now logged in";
                }
                else{
                    echo "Why " . $_SESSION['nickname'];
                }
        ?>
        <div class="header">
            <h2>Taste and Purchase Events</h2>
        </div>
        <form>
            <div class="input-group">
                <input class="input-group" type=button onClick="location.href='register.php'" value='Sign Up'>
            </div>
            <div class="input-group">
                <input class="input-group" type=button onClick="location.href='login.php'" value='Sign in'>
            </div>
            <?php if(isset($_SESSION['nickname'])){ ?>
            <div class="input-group">
                <input class="input-group" type=button onClick="location.href='login.php'" value='Sign in'>
            </div>
            <?php } ?>
    </form>
    </body>