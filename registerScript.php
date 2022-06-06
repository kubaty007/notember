<?php

session_start();

if(!isset($_POST['login']) || !isset($_POST['password'])){
    $_SESSION['error'] = "Fill in form";
    header('Location: register.php');
    exit();
}

    $login = $_POST['login'];
    $password = $_POST['password'];

    //validation

    if(empty($login)) {
        $_SESSION['error'] = "Empty login";
        header('Location: register.php');
        exit();
    }
    
    if(empty($password)) {
        $_SESSION['error'] = "Empty password";
        header('Location: register.php');
        exit();
    } 

    if(strlen($password)<6){
        $_SESSION['error'] = "Password is too short";
        header('Location: register.php');
        exit();
    }

    $login = filter_var($login, FILTER_SANITIZE_EMAIL);

    if(!filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email is incorrect";
        header('Location: register.php');
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

        $result = $db -> query("SELECT COUNT(login) as count from users where login = '".$login."';");

        while($usersCount = $result -> fetch_assoc()) {
            if($usersCount['count'] === '0') {
                
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                var_dump($hashedPassword);

                if($db -> query("INSERT INTO `users` (`login`, `password`) VALUES ('".$login."', '".$hashedPassword."');")) {
                    //header("Location: panel.html");
                    $db -> close();
                }

                //TODO
                else echo "error";
        
            } else {
                $_SESSION['error'] = "This login is already occupied";
                header('Location: register.php');
                $db -> close();
                exit();
            }
        }
    }

    

    




?>