<?php
  include_once 'includes/header.php';
?>
<title> Log in </title>

</head>
<body class="dark">

<!-- LOG IN/OUT MESSAGE BAR-->
<?php
if (isset($_SESSION['msg_success'])) {
  $msg_success = $_SESSION['msg_success'];
  echo '<div class="alert alert-success alert-dismissible fade in show" role="alert" >'.$msg_success.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
  </button></div>';
  session_unset();
  session_destroy();
} else {
  if (isset($_SESSION['msg_error'] )) {
    $msg_error = $_SESSION['msg_error'];
    echo '<div class="alert alert-danger alert-dismissible fade in show " id="dialog-message" role="alert">'.$msg_error.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button></div>';
    session_unset();
    session_destroy();
  }
}
?>

<!--FORM -->
          <div class="container log_in_section d-flex ">
            <div class="row">

<!--LOG IN SECTION-->
            <div class="sign_in_form">
              <form action="login.php" method="POST">
                <h2 class="header">sign in</h2>
                <input class="sign" type="text" name="us_name" placeholder="Username or email">
                <input class="sign" type="password" name="us_pass" placeholder="Password">
                <div class="text-right fLink" ><a href="forgotPass.php">Forgot your password?</a></div>

                <button id="buton" type="submit" name="us_submit" class="btn btn-primary btn-block btn_submit">Submit</button>
              </form>

        <!--REGISTER SECTION-->
         <div class="divider text-center mt-2 mb-1">
           <h6>New to "store/website name"?</h6>
         </div>
           <a class="btn btn-primary btn-block" href="signin.php" role="button">Create new account</a>
        </div>
    </div>
  </div>


<?php
  include_once 'includes/footer.php';
?>
