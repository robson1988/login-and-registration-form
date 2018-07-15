<?php
  include_once 'includes/header.php';
?>
<title> Reset Password </title>
</head>

<?php
include_once 'connect.php';
//check for valid data from URL
if(isset($_GET['username']) && !empty($_GET['username']) && isset($_GET['hash']) && !empty($_GET['hash']) && isset($_GET['token']) && !empty($_GET['token'])) {

  $username = mysqli_real_escape_string($connect, $_GET['username']);
  $hash = mysqli_real_escape_string($connect, $_GET['hash']);
  $token = mysqli_real_escape_string($connect, $_GET['token']);

  //check if token is still valid
  $sql = "SELECT * FROM passres WHERE u_token='$token'";
  $result = mysqli_query($connect, $sql);
  $fetchResult = $result->fetch_assoc();

  $userid = $fetchResult['u_id'];  //get user id from data base
  $resetTime = $fetchResult['u_resetTime']; // get timestamp grom database

  $date = date_create();  // create timestamp for date
  $currentTime = date_timestamp_get($date);
  $actionDate = date('Y-m-d H:i:s', $currentTime);  //set date to insert into database

  if ($currentTime - $resetTime > 3600) {
    $_SESSION['msg_error'] = "Sorry, reset link already expired.";
    header('Location: index.html');
    exit();
      } else {
        //check for existing user data and compare it with token given
        $sql = "SELECT users.u_username = '$username', users.u_hash = '$hash' FROM users, passres WHERE passres.u_token ='$token' AND users.u_id= passres.u_id";
        $result = mysqli_query($connect, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck == 0) {
          $_SESSION['msg_error'] = "Sorry, verification failed. Please try again later.";
          header('Location: index.html');
          exit();
        }
      }
} else {
  header('Location: index.html');
  exit();
}

?>
<body>
  <div class="reset d-flex ">
    <div class="row">
      <div class="sign_in_form">
        <form action="reset.php" method="POST">
          <h2 class="header">Reset your Password</h2>
          <input class="sign" type="password" name="newPass" placeholder="New Password">
          <input class="sign" type="password" name="newPassConfirm" placeholder="Confirm New Password">
          <input type="hidden" name="us_id" value="<?php echo $userid; ?>">
          <input type="hidden" name="us_username" value="<?php echo $username; ?>">
          <input type="hidden" name="us_hash" value="<?php echo $hash; ?>">
          <input type="hidden" name="us_date" value="<?php echo $actionDate; ?>">


          <button type="submit" name="us_submit" class="btn btn-primary btn-block">Apply</button>
        </form>
      </div>
</body>
</html>
