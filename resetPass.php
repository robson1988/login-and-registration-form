<?php
  include_once 'includes/header.php';
?>
<title> Reset Password </title>
</head>
<body class="dark">
<?php
include_once 'connect.php';
//check for valid data from URL
if(isset($_GET['username']) && !empty($_GET['username']) && isset($_GET['hash']) && !empty($_GET['hash']) && isset($_GET['token']) && !empty($_GET['token'])) {

  $username = mysqli_real_escape_string($connect, $_GET['username']);
  $hash = mysqli_real_escape_string($connect, $_GET['hash']);
  $token = mysqli_real_escape_string($connect, $_GET['token']);

  $_SESSION['hash'] = $hash;          //store data from GET METHOD in session variable
  $_SESSION['username'] = $username;  //store data from GET METHOD in session variable

  //check if token is still valid
  $sql = "SELECT * FROM passres_records WHERE u_token='$token'";
  $result = mysqli_query($connect, $sql);
  $fetchResult = $result->fetch_assoc();

  $_SESSION['userid'] = $fetchResult['u_id'];  //get user id from data base and store it in session
  $_SESSION['resetTime'] = $fetchResult['u_resetTime']; // get timestamp from database and store it in session

  $date = date_create();  // create timestamp for date
  $currentTime = date_timestamp_get($date);
  $actionDate = date('Y-m-d H:i:s', $currentTime);  //set date to insert into database
  $_SESSION['actionDate'] = $actionDate;            //store date as a session variable

  if ($currentTime - $_SESSION['resetTime'] > 3600) {

    $sql = "DELETE FROM passres_records WHERE u_token='$token' AND u_username='$username'"; //dalete token from database if is no longer valid
    mysqli_query($connect, $sql);
    
    $_SESSION['msg_error'] = "Sorry, reset link already expired.";
    header('Location: index.php');
    exit();
      } else {
        //check for existing user data and compare it with token given
        $sql = "SELECT users.u_username = '$username', users.u_hash = '$hash' FROM users, passres_records WHERE passres_records.u_token ='$token' AND users.u_id= passres_records.u_id";
        $result = mysqli_query($connect, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck == 0) {
          $_SESSION['msg_error'] = "Sorry, verification failed. Please try again later.";
          header('Location: index.php');
          exit();
        }
      }
} else {
  header('Location: index.php');
  exit();
}

?>

  <div class="reset d-flex ">
    <div class="row">
      <div class="sign_in_form">
        <form action="reset.php" method="POST">
          <h2 class="header">Reset your Password</h2>
          <input class="sign" type="password" name="newPass" placeholder="New Password">
          <input class="sign" type="password" name="newPassConfirm" placeholder="Confirm New Password">
          <button type="submit" name="us_submit" class="btn btn-primary btn-block">Apply</button>
        </form>
      </div>
</body>
</html>
