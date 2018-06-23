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

<!-- SIGN IN FORM -->
          <div class="container d-flex justify-content-center sign_in_form">
            <div class="row col-12 justify-content-center">
              <form  class="row col-12" action="login.php" method="POST">
                <div class="col text-left"><h1 class="header">sign in</h1></div>
                <div class="col text-center"><input class="sign_in" type="text" name="us_name" placeholder="Username or email"></div>
                <div class="col text-center"><input class="sign_in" type="password" name="us_pass" placeholder="Password"></div>
                <div class="col-12 text-right"><a href="reset.php">Forget your password?</a></div>
                <div class="col text-center"><input type="submit" name="us_submit" value="Submit"></div>
              </form>
            </div>
          </div>

<?php
  include_once 'includes/footer.php';
?>
