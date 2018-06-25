<?php
  include_once 'includes/header.php';
?>

<body>
<!-- LOG IN/OUT MESSAGE BAR -->
<div class="info_bar">
  <?php
  if (isset($_SESSION['log_in_error'] )) {
    $log_in_error = $_SESSION['log_in_error'];
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$log_in_error.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button></div>';
    session_unset();
    }
    elseif (isset($_SESSION['log_out_success'] )) {
      $log_out_success = $_SESSION['log_out_success'];
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$log_out_success.'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
      </button></div>';
      session_unset();
      session_destroy();
    }
  ?>
</div>

<!--FORM -->
          <div class="container log_in_section d-flex ">
            <div class="row">

<!--LOG IN SECTION-->
              <div class="sign_in_form">
                <form action="login.php" method="POST">
                  <h2 class="header">sign in</h2>
                  <input class="sign" type="text" name="us_name" placeholder="Username or email">
                  <input class="sign" type="password" name="us_pass" placeholder="Password">
                  <div class="text-right fLink" ><a href="reset.php">Forget your password?</a></div>
                  <button type="submit" name="us_submit" class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>

<!--REGISTER SECTION-->
              <div class="divider text-center mt-2 mb-1">
                <h6>New to "store/website name"?</h6>
              </div>
              <a class="btn btn-primary btn-block" href="sign_in.php" role="button">Create new account</a>
            </div>
          </div>

<?php
  include_once 'includes/footer.php';
?>
