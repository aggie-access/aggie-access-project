<?php
if (!empty($_GET['error'])) {
  $login_error="The username or password you have entered is incorrect.";
}
?>

<!DOCTYPE html>
<html lang="en" style="width:100%; height:100%;">

<head>
  <title>Home</title>
  <?php include 'assets/header.php'; ?>
  <link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css?v=<?php echo date('U'); ?>">
</head>

<body style="margin-top:0px; width:100%; height:100%;">

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container" style="height:80px;">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="width:325px;"></a>
      </div>
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
        <button type="submit" class="btn btn-default" name="login">Login</button>
      </form>
      <div class="login-error">
        <?php
        if(isset($login_error)) {
          echo $login_error;
        }
        ?>
      </div>
    </div>
  </div>

</body>

</html>
