<?php

    session_start();

    if(!isset($_POST['login']) || !isset($_POST['password'])){
        $_SESSION['error'] = "Fill in form";
        header('Location: index.php');
        exit();
    }

    $login = $_POST['login'];
    $password = $_POST['password'];


    if(empty($login)) {
        $_SESSION['error'] = "Empty login";
        header('Location: index.php');
        exit();
    }

    if(empty($password)) {
        $_SESSION['error'] = "Empty password";
        header('Location: index.php');
        exit();
    }

    $login = filter_var($login, FILTER_SANITIZE_EMAIL);

    if(!filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email is incorrect";
        header('Location: index.php');
        exit();
    }

    

    require_once('dbParameters.php');

    $db = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if($db -> connect_errno != 0) {
        echo "Nastąpił problem z połączeniem! <br/> Error: ".$db->connect_errno;
        $db -> close();
        exit();
    }
    else {
        $result = $db -> query("SELECT password FROM users WHERE login = '".$login."';");
        while($row = $result -> fetch_assoc()) {
            
            $hashedPassword = $row['password'];
        }
        
        
        if(password_verify($password, $hashedPassword)) {
            echo "Loged In!";
        }
        else {
            $_SESSION['error'] = "Login or password is incorrect";
            header("Location: index.php");
            exit();
        }
        
        

    }
    
?>