<?php
session_start();
  if(isset($_POST['us_submit'])) {

    include_once 'connect.php';

    $us_name = mysqli_real_escape_string($connect, $_POST['us_name']);
    $us_pass = mysqli_real_escape_string($connect, $_POST['us_pass']);
    //error handlers
    //empty input
    if (empty($us_name) || empty($us_pass)) {
      $_SESSION['msg_error'] = "Ooops! U forget to fill out all fields.";
      header("Location: index.html");
      exit();
    } else {
      $sql = "SELECT * FROM users WHERE u_username='$us_name' OR u_email='$us_name'";
      $result = mysqli_query($connect, $sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck < 1) {
        $_SESSION['msg_error'] = "Ooops! Username or Password doesn't match.";
        header("Location: index.html");
        exit();
      } else {
        if ($row = mysqli_fetch_assoc($result)) {
          //CHECKING PASSWORD MATCHING
          $hashedPwdCheck = password_verify($us_pass, $row['u_pass']);
          if($hashedPwdCheck == false ){
           $_SESSION['msg_error'] = "Ooops! Username or Password doesn't match.";
           header("Location: index.html");
           exit();
         } elseif ($hashedPwdCheck == true ) {
            //LOGIN USER
            $_SESSION['loged_in'] = true;
            $_SESSION['us_id'] = $row['u_id'];
            $_SESSION['us_name'] = $row['u_name'];
            $_SESSION['us_surname'] = $row['u_surname'];
            $_SESSION['us_status'] = $row['u_status'];
            $_SESSION['us_email'] = $row['u_email'];
            $_SESSION['us_adress'] = $row['u_adress'];
            $_SESSION['us_birthday'] = $row['u_birthday'];

            header("Location: panel.html");
            exit();
          }
        }
      }
    }
  } else {
  header("Location: index.html");
  exit();
}
