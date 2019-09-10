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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.png" type="image/png" sizes="16x16">
        <link href='https://fonts.googleapis.com/css?family=Proxima+Nova:400,700' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css">
    </head>

    <body style="margin-top:0px; width:100%; height:100%;">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container" style="height:80px;">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"><img src="images/Logo.png" style="width:325px;"></a>
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
                <form action="authenticate.php" method="post">
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
