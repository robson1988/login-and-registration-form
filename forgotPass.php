<?php
  include_once 'includes/header.php';
?>
<title> Forgot Password </title>
</head>
<body class="dark">
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
    header('Location: index.php');
    exit();
  } else {
      //user exist, fetch user data from database to array
      $user = $result->fetch_assoc();
      $id=$user['u_id'];
      $username=$user['u_username'];
      $email=$user['u_email'];
      $hash=$user['u_hash'];

      //generate password reset token
      $salt = rand(0,999);
      $date = date_create();
      $token = hash("sha256", date_timestamp_get($date).$salt);
      $time = date_timestamp_get($date);
	 

      //insert into db time and token
      $sql = "INSERT INTO passres_records (u_id, u_username, u_token, u_resetTime) VALUES ('$id', '$username','$token', '$time')";
      mysqli_query($connect, $sql);

      //session msg to display on success.php
      $_SESSION['msg_success'] = "<p>Please check your email $email
       for a confirmation link to complete your password reset!</p>";

      //send reset link reset.php
      $to = $email;
      $subject = 'Password reset link.';
	  $headers= "From: robert.bajoo@gmail.com\r\n";
      $message = 'Hello '.$username.',
      You have requested password reset!
      Please click this link to reset your password:
      http://localhost/login-and-registration-form-master/resetPass.php?username='.$username.'&hash='.$hash.'&token='.$token;
      mail($to, $subject, $message, $headers);
      header('Location: index.php');

  }
}

?>

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
