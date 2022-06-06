<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Notember | Create an account</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <div id="wrapper">
        <div id="right">
            <div id="panel">
                <div id="logo">

                </div>
                <form action="registerScript.php" method="post">
                        <div class="inputWrapper">
                            <label for="login">login</label><br/>
                            <input type="text" id="loginInput" name="login">
                        </div>
                        <div class="inputWrapper">
                            <label for="password">password</label><br/>
                            <input type="password" id="passwordInput" name="password" placeholder="min. 6 characters">
                        </div> 
                        <input type="submit" value="Create an account">
                        <?php
                                session_start();
                                if($_SESSION['error'] != '') {
                                    echo '<br/> <span style="color:red">'.$_SESSION['error'].'</span>';
                                    $_SESSION['error'] = '';
                                }
                        ?>
                </form>
                <div id="register">
                    Already have an account? <a href="index.php">Log in</a>
                </div>
            </div>
            <div id="copyriht">
                 &copy; 2022 Jakub All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>