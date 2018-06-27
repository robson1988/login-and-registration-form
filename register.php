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
  $new_us_pass_re = mysqli_real_escape_string($connect, $_POST['new_us_pass_re']);

  //ERROR HANDLERS
  //empty inputs
  if(empty($new_us_username) || empty($new_us_name) || empty($new_us_surname) || empty($new_us_mail) || empty($new_us_pass)) {
    $_SESSION['sign_in_error'] = "Empty fields left. All fields are required!";
    header('Location: sign_in.html');
    exit();
  }  else {
    //username length check
      if(strlen($new_us_username) < 5 || strlen($new_us_username) > 20) {
        $_SESSION['sign_in_error'] = "Incorrrect username. Username must be at least 5 characters long and contain one number!";
        header('Location: sign_in.html');
        exit();
        //username correct symbols check
        } else {
        if (!preg_match("/^[0-9a-zA-Z]*$/", $new_us_username)) {
          $_SESSION['sign_in_error'] = "Unvalid symbols in username field!";
          header('Location: sign_in.html');
          exit();
          } else {
          //username numbers contain check
          if (!preg_match("#[0-9]#", $new_us_username)) {
            $_SESSION['sign_in_error'] = "Username mus't contain at least one number!";
            header('Location: sign_in.html');
            exit();
            } else {
            //name and surname letters only check
            if(!preg_match("/^[a-zA-Z]*$/", $new_us_name) || !preg_match("/^[a-zA-Z]*$/", $new_us_surname)) {
              $_SESSION['sign_in_error'] = "Unvalid symbols. Name and surname must contain only letters!";
              header('Location: sign_in.html');
              exit();
              } else {
              //email validate and sanitize check
              $new_us_mailCheck = filter_var($new_us_mail, FILTER_SANITIZE_EMAIL);
              if(filter_var($new_us_mailCheck, FILTER_VALIDATE_EMAIL) == false || ($new_us_mail!=$new_us_mailCheck)) {
                $_SESSION['sign_in_error'] = "Invalid e-mail adress!";
                header('Location: sign_in.html');
                exit();
                } else {
                // password lenght check
                if(strlen($new_us_pass) < 6) {
                  $_SESSION['sign_in_error'] = "Password should be at least 6 characters long!";
                  header('Location: sign_in.html');
                  exit();
                  } else {
                  //passwords match check
                  if(($new_us_pass)!=($new_us_pass_re)) {
                    $_SESSION['sign_in_error'] = "Passwords doesn't match!";
                    header('Location: sign_in.html');
                    exit();
                    } else {
                    //checkbox checked
                    if(!isset($_POST['check_accept'])) {
                      $_SESSION['sign_in_error'] = "To register you have to accept our policy!";
                      header('Location: sign_in.html');
                      exit();
                      } else {
                      //captcha check
                      $secretKey = "6Lcqp2AUAAAAAJKYQJCNxYMsYNIJfgTUvyASOQbd";
                      $captchaCheck = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);
                      $validate = json_decode($captchaCheck);
                      if($validate->success == false) {
                        $_SESSION['sign_in_error'] = "Captcha required!";
                        header('Location: sign_in.html');
                        exit();
                        } else {
                          


                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
} else {
    header("Location: register.php");
    exit();

}
