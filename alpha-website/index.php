<?php
$error=$_GET["error"];
if (!empty($error)) {
    $login_error="The username or password you have entered is incorrect.";
}
?>

<!DOCTYPE html>
<html lang="en" style="width:100%; height:100%;">

    <head>
        <title>Home</title>
        <?php include 'assets/header.php'; ?>
    </head>

    <body style="margin-top:0px; width:100%; height:100%;">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container" style="height:80px;">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="width:325px;"></a>
                </div>
                <ul class="nav navbar-nav navbar-right contact-us">
                    <li><a href="https://www.ncat.edu/" target="_blank" class="contact-us">
                        <i class="fas fa-envelope" style="margin-right:5px;"></i>Contact Us</a></li>
                </ul>
            </div>
        </nav>

        <div id="outer">
            <div id="container">
                <h2>Welcome!</h2>
                <form action="assets/authenticate.php" method="post">
                    <div class="form-group">
                        <label>Banner ID</label>
                        <input type="username" class="form-control" name="username" minlength="9" maxlength="9" size="9" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-default">Login</button>
                </form>
                <div class="login-error"><?php echo $login_error; ?></div>
            </div>
        </div>

    </body>

</html>
