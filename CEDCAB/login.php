<?php
include 'login_valid.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ADMIN/style.css">
    <title>register Yourself</title>
</head>
<body>
    <header>
        <div class="top-foot">
            Welcome to The Ced-Cab PORTAL 
        </div>
        <div class="login_info"> Heiiiiii--- Hello before try tp login ..you have to make sure you are already registred, If you not registered --first register yoursel</b></div>
    </header>
    <section>
        <div class="signuptable">
            <form action="" method="POST">
                <table class='login-register'>
                    <tr>
                        <td>USER NAME</td>
                        <td><input type="text" name='username' id="username" value="<?php if(isset($_COOKIE["user"])) { echo $_COOKIE["user"]; } ?>"><span><?php echo $username_err; ?></span></td>
                    </tr>
                    <tr>
                        <td>PASSWORD </td>
                        <td><input type="password" name='password' id="password" value="<?php if(isset($_COOKIE["pass"])) { echo ($_COOKIE["pass"]); } ?>"><span><?php echo $password_err; ?></span><span><?php echo $incorrect; ?></span></td>
                    </tr>
                        <tr>
                            <td><input type="checkbox" id="cookie-check" name="remember"> </td>
                            <td>Remeber the login_id and Password </span></td>
                        </tr>
                    <tr>
                        <td> <a href="registerpage.php">REGISTER</a></td> 
                        <td> <input type="submit" name="login" value="LOGIN"> </td>                                         
                    </tr>
                </table>
            </form>
        </div>
    </section>
    <footer>
        <div class="top-foot">
            developed and designed by cedcoss
        </div>
    </footer>
</body>
</html>