<?php

session_start();

include_once 'connect.php';

if(isset($_GET['username']) && !empty($_GET['username']) && isset($_GET['hash']) && !empty($_GET['hash'])) {

  $username = mysqli_real_escape_string($connect, $_GET['username']);
  $hash = mysqli_real_escape_string($connect, $_GET['hash']);

  $sql = "SELECT * FROM users WHERE u_username='$username' AND u_hash='$hash'";

  $result = mysqli_query($connect, $sql);
  $resultCheck = $result->fetch_assoc();

  $active = $resultCheck['active'];
  $userid = $resultCheck['u_id'];
  $action = "Account activation";
  $date = date('y-m-d H:i:s');

  //ACOUNT ACTIVATION CHECK
  if($active == 1){
    $_SESSION['msg_error'] = "Account have been already activated. You can login to your account.";
    header('Location: index.php');
    exit();
  } else {
    $sql = "UPDATE users SET active='1' WHERE u_username='$username' AND u_hash='$hash'";

    mysqli_query($connect, $sql);

    //INSERT ACTION TAKEN BY USER FOR DATABSE RECORDS
    $dataInsert = "INSERT INTO dbaction (u_id, u_username, u_action, action_date)
                   VALUES ('$userid', '$username', '$action', '$date')";

    mysqli_query($connect, $dataInsert);

    $_SESSION['msg_success'] = "Account activated. You can login to your account.";
    header('Location: index.php');
    exit();
  }

} else {
  $_SESSION['msg_error'] = "Activation failed, please try again.";
  header('Location: index.php');
  exit();

}
