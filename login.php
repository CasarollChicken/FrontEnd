<?php include('server.php');

?>
<!DOCTYPE html>
<html>
  <head>
    <title>User Registration System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
      <div class="header">
        <h2>Login</h2>
      </div>
      <form method="post" action="login.php">
        <!-- Display Validation Errors here-->
        <?php include('errors.php'); ?>
        <div class="input-group">
          <label>Username:</label>
          <input type="text" name="username">
        </div>
        <div class="input-group">
          <label>Password:</label>
          <input type="password" name="password">
        </div>
        <div class="input-group">
          <button type="submit" name="login">Login</button>
        </div>
        <p>
          Not a member? <a href="register.php">Sign up</a>
        </p>
      </form>

  </body>
</html>
