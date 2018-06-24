<?php
  include_once 'includes/header.php';
?>

<body>
<!-- SIGN IN/OUT MESSAGE BAR -->
<div class="error_bar">
  <?php
  if (isset($_SESSION['sign_in_error'] )) {
    $sign_in_error = $_SESSION['sign_in_error'];
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$sign_in_error.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button></div>';
    session_unset();
    }
    elseif (isset($_SESSION['sign_out_success'] )) {
      $sign_out_success = $_SESSION['sign_out_success'];
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$sign_out_success.'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
      </button></div>';
      session_unset();
      session_destroy();
    }
  ?>
</div>

<!--FORM -->
          <div class="container d-flex justify-content-center sign_in_form">
            <div class="row col-12 justify-content-center">

<!--NAVIGATION-->
  <div class="row align-top ">
    <ul class="nav nav-pills m-auto text-center  " >
      <li class="nav-item"><a class="nav-link active" href="#login" role="tab" data-toggle="pill">Login</a></li>
      <li class="nav-item"><a class="nav-link" href="#register" role="tab" data-toggle="pill">Sign Up</a></li>
    </ul>
  </div>
<!--LOG IN FORM-->
              <div class="tab-content">
                <div class="tab-pane fade show active" role="tabpanel" id="login">
                  <form class="justify-content-center " action="login.php" method="POST">
                  <h2 class="header">sign in</h2>
                  <input class="sign" type="text" name="us_name" placeholder="Username or email">
                  <input class="sign" type="password" name="us_pass" placeholder="Password">
                  <div class="text-right fLink" ><a href="reset.php">Forget your password?</a></div>
                  <button type="submit" name="us_submit" class="btn btn-primary btn-block">Submit</button>
                  </form>
                </div>
<!--SIGN IN FORM-->
                <div class="tab-pane fade"  role="tabpanel" id="register">
                    <form  class="justify-content-center" action="login.php" method="POST">
                    <h2 class="header">Sign Up</h2>
                      <input class="sign" type="text" name="new_us_username" placeholder="Username">
                      <input class="sign" type="text" name="new_us_name" placeholder="Name">
                      <input class="sign" type="text" name="new_us_surname" placeholder="Surname">
                      <input class="sign" type="e-mail" name="new_us_mail" placeholder="Email">
                      <input class="sign" type="password" name="new_us_pass" placeholder="Password">
                      <button type="submit" name="us_submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
              </div>
            </div>
          </div>

<?php
  include_once 'includes/footer.php';
?>
