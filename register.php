<?php
session_start();

if (isset($_POST['new_us_submit'])) {

  include_once 'connect.php';

  $new_us_username = mysqli_real_escape_string($connect, $_POST['new_us_username']);
  $new_us_name = mysqli_real_escape_string($connect, $_POST['new_us_name']);
  $new_us_surname = mysqli_real_escape_string($connect, $_POST['new_us_surname']);
  $new_us_mail = mysqli_real_escape_string($connect, $_POST['new_us_mail']);
  $new_us_pass = mysqli_real_escape_string($connect, $_POST['new_us_pass']);
  $new_us_pass_re = mysqli_real_escape_string($connect, $_POST['new_us_pass_re']);
  //hash key to verify account
  $hash = mysqli_real_escape_string($connect, md5(rand(0, 1000)));

  //ERROR HANDLERS
  // remember provided input fileds
  $_SESSION['remInUser'] = $new_us_username;
  $_SESSION['remInName'] = $new_us_name;
  $_SESSION['remInSur'] = $new_us_surname;
  $_SESSION['remInMail'] = $new_us_mail;
  if(isset($_POST['check_accept'])) $_SESSION['remInCheck'] = true;

  //empty inputs
  if(empty($new_us_username) || empty($new_us_name) || empty($new_us_surname) || empty($new_us_mail) || empty($new_us_pass)) {
    $_SESSION['msg_error'] = "Empty fields left. All fields are required!";
    header('Location: signin.html');
    exit();
  }  else {
    //username length check
      if(strlen($new_us_username) < 5 || strlen($new_us_username) > 20) {
        $_SESSION['msg_error'] = "Incorrrect username. Username must be at least 5 characters long and contain one number!";
        header('Location: signin.html');
        exit();
        //username correct symbols check
        } else {
        if (!preg_match("/^[0-9a-zA-Z]*$/", $new_us_username)) {
          $_SESSION['msg_error'] = "Unvalid symbols in username field!";
          header('Location: signin.html');
          exit();
          } else {
          //username numbers contain check
          if (!preg_match("#[0-9]#", $new_us_username)) {
            $_SESSION['msg_error'] = "Username mus't contain at least one number!";
            header('Location: signin.html');
            exit();
            } else {
            //name and surname letters only check
            if(!preg_match("/^[a-zA-Z]*$/", $new_us_name) || !preg_match("/^[a-zA-Z]*$/", $new_us_surname)) {
              $_SESSION['msg_error'] = "Unvalid symbols. Name and surname must contain only letters!";
              header('Location: signin.html');
              exit();
              } else {
              //email validate and sanitize check
              $new_us_mailCheck = filter_var($new_us_mail, FILTER_SANITIZE_EMAIL);
              if(filter_var($new_us_mailCheck, FILTER_VALIDATE_EMAIL) == false || ($new_us_mail!=$new_us_mailCheck)) {
                $_SESSION['msg_error'] = "Invalid e-mail adress!";
                header('Location: signin.html');
                exit();
                } else {
                // password lenght check
                if(strlen($new_us_pass) < 6) {
                  $_SESSION['msg_error'] = "Password should be at least 6 characters long!";
                  header('Location: signin.html');
                  exit();
                  } else {
                  //passwords match check
                  if(($new_us_pass)!=($new_us_pass_re)) {
                    $_SESSION['msg_error'] = "Passwords doesn't match!";
                    header('Location: signin.html');
                    exit();
                    } else {
                    //checkbox checked
                    if(!isset($_POST['check_accept'])) {
                      $_SESSION['msg_error'] = "To register you have to accept our policy!";
                      header('Location: signin.html');
                      exit();
                      } else {
                      //captcha check
                      $secretKey = "6Lcqp2AUAAAAAJKYQJCNxYMsYNIJfgTUvyASOQbd";
                      $captchaCheck = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);
                      $validate = json_decode($captchaCheck);
                      if($validate->success == false) {
                        $_SESSION['msg_error'] = "Captcha required!";
                        header('Location: signin.html');
                        exit();
                        } else {
                        //connection check
                          try {
                            if($connect->connect_errno!=0) {
                              throw new Exception(mysqli_connect_errno());
                            } else {
                              //comparing existing emails in database with provided email in registration form
                              $sql= "SELECT * FROM users WHERE u_email = '$new_us_mail'";
                              $result = mysqli_query($connect, $sql);
                              $resultCheck = mysqli_num_rows($result);
                              if($resultCheck > 0) {
                                $_SESSION['msg_error'] = "Email adress already in use!";
                                header('Location: signin.html');
                                exit();
                              } else {
                                //comparing existing username in database with provided username in registration form
                                $sql = "SELECT * FROM users WHERE u_username = '$new_us_username'";
                                $result = mysqli_query($connect, $sql);
                                $resultCheck = mysqli_num_rows($result);
                                if($resultCheck > 0) {
                                  $_SESSION['msg_error'] = "Username already in use!";
                                  header('Location: signin.html');
                                  exit();
                                } else {
                                  //password hashing
                                  $hashedPwd = password_hash($new_us_pass, PASSWORD_DEFAULT);
                                  //creating new user in database and inserting provided data
                                  $sql = "INSERT INTO users (u_username, u_name, u_surname, u_status, u_email, u_pass, u_adress, u_birthday)
                                          VALUES ('$new_us_username', '$new_us_name', '$new_us_surname', 'USER', '$new_us_mail' , '$hashedPwd', NULL, NULL)";
                                  $result = mysqli_query($connect, $sql);
                                  $_SESSION['msg_success'] = "New account created!";
                                  header('Location: index.html');
                                }
                              }
                              $connect->close();
                              exit();
                            }
                          } catch (Exception $e) {
                            echo "Blad serwer, przepraszamy za niedogodnienia!";
                            echo '<br/>Informacja developerska: '.$e;
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
  }
} else {
    header("Location: register.php");
    exit();

}
