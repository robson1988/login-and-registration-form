<?php
  include_once 'includes/header.php';
?>

<body>
<!-- SIGN IN MESSAGE BAR -->
<div class="info_bar">
  <?php
  if (isset($_SESSION['sign_in_error'] )) {
    $sign_in_error = $_SESSION['sign_in_error'];
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$sign_in_error.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button></div>';
    session_unset();
    }
  ?>
</div>

<!--FORM -->
          <div class="container sign_in_section d-flex">
            <div class="row">
<!--SIGN IN FORM-->
                  <div class="sign_in_form">
                    <form action="sign_in.php" method="POST">
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

<?php
  include_once 'includes/footer.php';
?>
