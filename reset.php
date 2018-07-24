<?php
//ykg
include_once 'connect.php';
//include_once 'includes/dbAction.php';
session_start();
print_r($_POST);
/*
if(!isset($_POST['us_submit'])) {
  header('Location: index.html');
  exit();

} else {
print_r($_POST);
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $newPass = mysqli_real_escape_string($connect, $_POST['newPass']);
    $newPassConfirm = mysqli_real_escape_string($connect, $_POST['newPassConfirm']);
      if($newPass == $newPassConfirm) {

        if(strlen($newPass) < 6) {

          $_SESSION['msg_error'] = "To short password, 6 characters minimum! PLease try again.";
          header('Location: index.html');
          exit();
          } else {
          $password = password_hash($newPass, PASSWORD_DEFAULT);

          $userid = mysqli_real_escape_string($connect, $_POST['us_id']);
          $username = mysqli_real_escape_string($connect, $_POST['us_username']);
          $hash = mysqli_real_escape_string($connect, $_POST['us_hash']);
          $action = "Password Reset"; //action taken to db records
          $date = mysqli_real_escape_string($connect, $_POST['us_date']);

          //UPDATE PASSWORD IN DATABASE
          $sql = "UPDATE users SET u_pass='$password' WHERE u_username='$username' AND u_hash='$hash'";

          mysqli_query($connect, $sql);

          //INSERT ACTION TAKEN BY USER FOR DATABSE RECORDS
          $dataInsert = "INSERT INTO dbaction (u_id, u_username, u_action, action_date)
                         VALUES ('$userid', '$username', '$action', '$date')";

          mysqli_query($connect, $dataInsert);

          //DALETE TEPORARY DATA FROM TABLE AFTER COMPLETED ACTION
          $dataDelete = "DELETE FROM passres WHERE u_id='$userid' AND u_username='$username'";

          mysqli_query($connect, $dataDelete);

          $_SESSION['msg_success'] = "Your password has been updated.";
          header('Location: index.html');
          exit();
          }
      }
  } else {
  $_SESSION['msg_error'] = "Sorry, passwords does't match. Please try again.";
  header('Location: index.html');
  exit();
}
}*/
