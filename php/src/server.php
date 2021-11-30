<?php
    //CREAZIONE DB
    $host = "db";
    $root = "root";
    $root_password = "MYSQL_ROOT_PASSWORD";

    $dbname = "TAPdb"; //TAP = TasteAndPurchase

    try {
        $conn = new PDO("mysql:host=$host", $root, $root_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $conn->query($sql);
        $conn->query("use $dbname");
    }
    catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $sqls=[
    'CREATE TABLE IF NOT EXISTS users (
        user_id int AUTO_INCREMENT NOT NULL,
        email varchar(255)  NOT NULL,
        pass varchar(255)  NOT NULL,
        nickname varchar(255) NULL,
        PRIMARY KEY(user_id)
    );',
    'CREATE TABLE IF NOT EXISTS producers (
        producer_id int AUTO_INCREMENT NOT NULL,
        name varchar(255) NOT NULL,
        mail varchar(255) NOT NULL,
        phone varchar(255) NOT NULL,
        zipcode varchar(255) NOT NULL,
        city varchar(255) NOT NULL,
        country varchar(255) NOT NULL,
        address varchar(255) NOT NULL,
        PRIMARY KEY(producer_id)
    );',
    'CREATE TABLE IF NOT EXISTS prices (
        price_id int AUTO_INCREMENT NOT NULL,
        quantity varchar(255) NOT NULL,
        price double NOT NULL,
        PRIMARY KEY(price_id)
    );',
    'CREATE TABLE IF NOT EXISTS products (
        product_id int AUTO_INCREMENT NOT NULL,
        title varchar(255) NOT NULL,
        descr varchar(255) NULL,
        price_id int,
        producer_id int,
        PRIMARY KEY(product_id),
        FOREIGN KEY(price_id) REFERENCES prices(price_id) ON DELETE CASCADE,
        FOREIGN KEY(producer_id) REFERENCES producers(producer_id) ON DELETE CASCADE
    );',
    'CREATE TABLE IF NOT EXISTS events (
        event_id int AUTO_INCREMENT NOT NULL,
        startdate DATE NOT NULL,
        enddate DATE NOT NULL,
        title varchar(255) NOT NULL,
        descr varchar(255) NULL,
        user_id int,
        product_id int,
        PRIMARY KEY(event_id),
        FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE, 
        FOREIGN KEY(product_id)  REFERENCES products(product_id) ON DELETE CASCADE
    );'
    ];
    try{
        foreach ($sqls as $sql) {
            $conn->exec($sql);
        }
    }
    catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    /////////////////////////////////////////////////
    
    if (isset($_POST['reg_user'])){
        if(!isset($_POST['username'])){
            $username = $_POST['email'];
        }
        else{
            $username = $_POST['username'];
        }        
        $mail = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        if ($password1 == $password2){
            $password = $password1;
        }

        $sql = "INSERT INTO users(email,pass,nickname) VALUES (:email,:pass,:username)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $mail, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $password, PDO::PARAM_STR);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
    }
        //$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // hash memorizzato nel database
        //if (!$username || !$password) {
        //    $error = 'Mail e password sono obbligatori';
        //}

        //if (password_verify($userPassword, $hashedPassword)) {
        //    echo "Accesso effettuato con successo";
        //} else {
        //    echo "La password inserita non è corretta";
        //}


        // receive all input values from the form
        //$username = mysqli_real_escape_string($db, $_POST['username']);
        //$email = mysqli_real_escape_string($db, $_POST['email']);
        //$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        //$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
      
        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        //if (empty($username)) { array_push($errors, "Username is required"); }
        //if (empty($email)) { array_push($errors, "Email is required"); }
        //if (empty($password_1)) { array_push($errors, "Password is required"); }
        //if ($password_1 != $password_2) {
        //  array_push($errors, "The two passwords do not match");
        //}
      
        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        //$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        //$result = mysqli_query($db, $user_check_query);
        //$user = mysqli_fetch_assoc($result);
        //
        //if ($user) { // if user exists
        //  if ($user['username'] === $username) {
        //    array_push($errors, "Username already exists");
        //  }
      //
        //  if ($user['email'] === $email) {
        //    array_push($errors, "email already exists");
        //  }
        //}
      //
        //// Finally, register user if there are no errors in the form
        //if (count($errors) == 0) {
        //    $password = md5($password_1);//encrypt the password before saving in the database
      //
        //    $query = "INSERT INTO users (username, email, password) 
        //              VALUES('$username', '$email', '$password')";
        //    mysqli_query($db, $query);
        //    $_SESSION['username'] = $username;
        //    $_SESSION['success'] = "You are now logged in";
        //    header('location: index.php');
        //}
        
    
    
    /////////////////////////////////////////////////

    if (isset($_POST['login_user'])) {
        
        $email =  $_POST['email'];
        $password = $_POST['password'];
    
        if (empty($email)) {
            echo "Username is required";
        }
        if (empty($password)) {
            echo "Password is required";
        }
    
        $sql = "SELECT email,nickname FROM users WHERE email=:email AND pass =:pass";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $password, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['nickname'] = $row['nickname'];
            //echo $_SESSION['nickname'];
            //header("Location:index.php");
            //exit();
        }
        //if (count($errors) == 0) {
        //    $password = md5($password);
        //    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        //    $results = mysqli_query($db, $query);
        //    if (mysqli_num_rows($results) == 1) {
        //    $_SESSION['username'] = $username;
        //    $_SESSION['success'] = "You are now logged in";
        //    header('location: index.php');
        //    }else {
        //        array_push($errors, "Wrong username/password combination");
        //    }
        //}
    }

?>