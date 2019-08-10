<?php
    session_start();
    $username = "";
    $email = "";
    $errors = array();

    //connect to the database
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $db = new mysqli('localhost', 'root', '', 'regist');
    $db->set_charset("utf8");

    //if the register is clicked
    if (isset($_POST['register'])) {
        //ensure the form fields are filled properly
        if (empty($_POST['username'])) {
            array_push($errors, "Username is required");
        }
        if (empty($_POST['email'])) {
            array_push($errors, "Email is required");
        }
        if (empty($_POST['password_1'])) {
            array_push($errors, "Password is required");
        }
        if ($_POST['password_1'] != $_POST['password_2']) {
            array_push($errors, "The two password do not match");
        }

        if (!count($errors)) {
            $password = password_hash($_POST['password_1'], PASSWORD_DEFAULT);
            $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $_POST['username'], $_POST['email'], $_POST['password_1']);
            $stmt->execute();
            $stmt->close();

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php'); //redirect to home page
        }
    }


    //log user in from the login Page
    if (isset($_POST['login'])) {
      if (empty($_POST['username'])) {
          array_push($errors, "Username is required");
      }
      if (empty($_POST['password'])) {
          array_push($errors, "Password is required");
      }
      if (count($errors) == 0) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
          // log user in
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php'); //redirect to home page
        }else {
          array_push($errors, "The username/password combination is incorrect");
        }
      }



    //logout
    if (isset($_GET['logout'])) {
      session_destroy();
      unset($_SESSION['username']);
      header('location: login.php');
    }

 ?>
