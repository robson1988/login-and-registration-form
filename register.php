<?php
session_start();
//6Lcqp2AUAAAAAJKYQJCNxYMsYNIJfgTUvyASOQbd
if (isset($_POST['new_us_submit'])) {

  include_once 'connect.php';

  $new_us_username = mysqli_real_escape_string($connect, $_POST['new_us_username']);
  $new_us_name = mysqli_real_escape_string($connect, $_POST['new_us_name']);
  $new_us_surname = mysqli_real_escape_string($connect, $_POST['new_us_surname']);
  $new_us_mail = mysqli_real_escape_string($connect, $_POST['new_us_mail']);
  $new_us_pass = mysqli_real_escape_string($connect, $_POST['new_us_pass']);

  //ERROR HANDLERS
  //empty inputs
  if(empty($new_us_username) || empty($new_us_name) || empty($new_us_surname) || empty($new_us_mail) || empty($new_us_pass)) {
    $_SESSION['sign_in_error'] = "Empty fields left. All fields are required!";
    header('Location: sign_in.html');
    exit();
  }  else {
    //username length
      if(strlen($new_us_username) < 5 || strlen($new_us_username) > 20) {
        $_SESSION['sign_in_error'] = "Incorrrect username. Username must be at least 5 letter long and contain one number!";
        header('Location: sign_in.html');
        exit();
        //username correct symbols use
        } else {
        if (!preg_match("/^[0-9a-zA-Z]*$/", $new_us_username)) {
          $_SESSION['sign_in_error'] = "Unvalid symbols in username field!";
          header('Location: sign_in.html');
          exit();
          } else {
          //username contain numbers
          if (!preg_match("#[0-9]#", $new_us_username)) {
            $_SESSION['sign_in_error'] = "Username mus't contain at least one number!";
            header('Location: sign_in.html');
            exit();
          } else {

            
        }
      }
    }
  }
} else {

    header("Location: register.php");
    exit();

}
