<?php
//ykg
include_once 'connect.php';
session_start();

if(!isset($_POST['us_submit'])) {
  header('Location: index.html');
  exit();

} else {

  if($_SERVER['REQUEST_METHOD'] == 'POST') {

      if($_POST['newPass'] == $_POST['newPassConfirm']) {

        $newPass = password_hash($_POST['newPass'], PASSWORD_DEFAULT);

        $username = mysqli_real_escape_string($connect, $_POST['us_username']);
        $hash = mysqli_real_escape_string($connect, $_POST['us_hash']);

        $sql = "UPDATE users SET u_pass='$newPass' WHERE u_username='$username' AND u_hash='$hash'";
        mysqli_query($connect, $sql);

        $_SESSION['msg_success'] = "Your password has been updated.";
        header('Location: index.html');
        exit();

      } else {
        $_SESSION['msg_error'] = "Sorry, passwords does't match. Please try again.";
        header('Location: index.html');
        exit();
      }
  }
}
