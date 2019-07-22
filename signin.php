<?php
  include_once 'includes/header.php';
?>
<title> Create new account </title>
</head>
<body class="dark">
<!--FORM -->
          <div class="container sign_in_section d-flex">
            <div class="row">
<!--SIGN IN FORM-->
                  <div class="sign_in_form">
                    <form action="register.php" method="POST">

                      <h2 class="header">Sign Up</h2>
                      <input class="sign" type="text" name="new_us_username" placeholder="Username" value="<?php if(isset($_SESSION['remInUser'])) { echo $_SESSION['remInUser'];} ?>">
                      <input class="sign" type="text" name="new_us_name" placeholder="Name" value="<?php if(isset($_SESSION['remInName'])) { echo $_SESSION['remInName'];} ?>">
                      <input class="sign" type="text" name="new_us_surname" placeholder="Surname" value="<?php if(isset($_SESSION['remInSur'])) { echo $_SESSION['remInSur'];} ?>">
                      <input class="sign" type="e-mail" name="new_us_mail" placeholder="Email" value="<?php if(isset($_SESSION['remInMail'])) { echo $_SESSION['remInMail'];} ?>">
                      <input class="sign" type="password" name="new_us_pass" placeholder="Password">
                      <input class="sign" type="password" name="new_us_pass_re" placeholder="Re-enter password">
<!-- CHECKBOX-->
                      <div class="checkbox mt-3">
                        <div class="input-group-text">
                          <input type="checkbox" name="check_accept" <?php if(isset($_SESSION['remInCheck'])) { echo "checked";} ?>>
                          <p class=" policy">Accept our policy</p>
                        </div>
                      </div>
<!-- CAPCHA-->
                      <div class="captcha mt-2">
                        <div class="g-recaptcha" data-sitekey="6Lcqp2AUAAAAAEQLdXQtIlNDL6bidymAEPkP0HER"></div>
                      </div>
<!-- SIGN IN MESSAGE BAR -->
                      <div class="result">
                      <?php
                      if (isset($_SESSION['msg_error'] )) {
                        $msg_error = $_SESSION['msg_error'];
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$msg_error.'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button></div>';
                        }
                      ?>
                    </div>
                      <button type="submit" name="new_us_submit" class="btn btn-primary btn-block">Create your account</button>
                    </form>




              </div>
            </div>
          </div>

<?php
  include_once 'includes/footer.php';
?>
