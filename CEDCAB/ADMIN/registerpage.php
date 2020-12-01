<?php include 'register_insert.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>register Yourself</title>
</head>
<body>
    <header>
        <div class="top-foot">
            Welcome to The Ced-Cab PORTAL 
        </div>
    </header>
    <section>
        <div class="signuptable">
            <div>
            <?php echo $correct; ?> 
            <?php echo $incorrect; ?> 
            </div>
            <form action="" method="POST">
                <table class = "login-register">
                    <tr>
                        <td>USER NAME</td>
                        <td><input type="text" name='username' id="username"><span><?php echo $username_err; ?></span></td>
                    </tr>
                    <tr>
                        <td>NAME</td>
                        <td><input type="text" name='name' id="name"><span><?php echo $name_err; ?></span></td>
                    </tr>
                    <tr>
                        <td>PASSWORD </td>
                        <td><input type="password" name='password' id="password"><span><?php echo $password_err; ?></span></td>
                    </tr>
                    <tr>
                        <td>RE-PASSWORD </td>
                        <td><input type="password" name='repassword' id="repassword"><span><?php echo $repassword_err; ?><span><?php echo $not_match; ?></span></td>
                    </tr>
                    <tr>
                        <td>MOBILE </td>
                        <td><input type="text" name='mobile' id="mobile"><span><?php echo $mobile_err; ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="2"> <input type="submit" name="register" value="REGISTER YOUR SELF"> </td>                   
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