<?php
  include_once 'includes/header.php';
?>
<title> Reset Password </title>
</head>
<?php
include_once 'connect.php';
//check for valid data from URL
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {

  $email = mysqli_real_escape_string($connect, $_GET['email']);
  $hash = mysqli_real_escape_string($connect, $_GET['hash']);
  //check for existing user data
  $sql = "SELECT * FROM users WHERE u_email='$email' AND u_hash='$hash'";
  $result = mysqli_query($connect, $sql);
  $resultCheck = mysqli_num_rows($result);
  if($resultCheck == 0) {
    $_SESSION['msg_error'] = "Sorry, verification failed1. Please try again later.";
    header('Location: index.html');
    exit();
    }
      } else {
      $_SESSION['msg_error'] = "Sorry, verification failed. Please try again later.";
      header('Location: index.html');
      exit();
      }
?>
<body>
  <div class="reset d-flex ">
    <div class="row">
      <div class="sign_in_form">
        <form action="" method="POST">
          <h2 class="header">Reset your Password</h2>
          <input class="sign" type="password" name="newPass" placeholder="New Password" required>
          <input class="sign" type="password" name="newPassCon" placeholder="Confirm New Password" required>
          <input type="hidden" name="us_email" value="<?php $email ?>">
          <input type="hidden" name="us_hash" value="<?php $hash ?>">
          <button type="submit" name="us_submit" class="btn btn-primary btn-block">Apply</button>
        </form>
      </div>
</body>
