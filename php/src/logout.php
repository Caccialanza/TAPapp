<!DOCTYPE html>
<html>
    <head>
        <title>Logout</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="header">
            <h2>Logout</h2>
        </div>
        <form method="post" action="register.php">
            <div class="input-group">
                <?php //session_destroy();
                    $_SESSION = []; ?>
                <label>Logout complete! Click to return to homepage</label>
                <input type=button onClick="location.href='index.php?logout=true'" value='Return'>
            </div>
        </form>
    </body>
</html>