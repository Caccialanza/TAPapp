<?php include('server.php');
    //if(isset($_SESSION['nickname'])){
    //    header("location:index.php");
    //    exit();
    //}
?>
    <!DOCTYPE html>
    <html>
    <head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <div class="header">
        <h2>Sign In</h2>
    </div>
        
    <form method="post" action="login.php">
        <?php //include('errors.php'); ?>
        <div class="input-group">
            <label>E-mail</label>
            <input type="text" name="email" >
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
            Not yet a member? <a href="register.php">Sign up</a>
        </p>
    </form>
    </body>
</html>