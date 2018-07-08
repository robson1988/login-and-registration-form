<?php
  include_once 'includes/header.php';
?>
<title> Forgot Password </title>
</head>
<?php
include_once 'connect.php';
// check if data is sent by post method
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $us_mail = mysqli_real_escape_string($connect, $_POST['us_mail']);
  $sql = "SELECT * FROM users WHERE u_email ='$us_mail'";
  $result = mysqli_query($connect, $sql);
  $resultCheck = mysqli_num_rows($result);
  //user doesn't exist
  if($resultCheck == 0) {
    $_SESSION['msg_error'] = "User with that email doesn't exist!";
    header('Location: index.html');
    exit();
  } else {
      //user exist, fetch user data from database to array
      $user = $result->fetch_assoc();
      $email=$user['u_email'];
      $hash=$user['u_hash'];
      $name=$user['u_name'];
      $username=$user['u_username'];
      //timezone and request time set
      date_default_timezone_set('Europe/London');
      $time = date('y.m.d h:i:s');
      //insert into db time and token
      $sql = "INSERT INTO passres (u_username, u_token, u_resetTime) VALUES ('$username','$hash', '$time')";
      mysqli_query($connect, $sql);
      //session msg to display on success.php
      $_SESSION['msg_success'] = "<p>Please check your email <span>$email</span>"
      . " for a confirmation link to complete your password reset!</p>";

      //send reset link reset.php
      $to = $email;
      $subject = 'Password reset link.';
      $message = 'Hello'.$name.',
      You have requested password reset!
      Please click this link to reset your password:
      http://localhost/GITHUB-LOGIN_AND_REGISTRATION_FORM/resetPass.php?email='.$email.'&hash='.$hash;
      mail($to, $subject, $message);
      header('Location: index.html');

  }
}

?>
<body>
  <div class="reset d-flex ">
    <div class="row">
      <div class="sign_in_form">
        <form action="forgotPass.php" method="POST">
          <h2 class="header">Reset your Password</h2>
          <input class="sign" type="text" name="us_mail" placeholder="Email Adress" required>
          <button type="submit" name="us_submit" class="btn btn-primary btn-block">Reset</button>
        </form>
      </div>
</body>
