<?php
  session_start();

?>



<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" >
</head>
<body>
<!-- SIGN IN ERROR MESSAGE BAR -->
<div class="error_bar">
  <?php
    if(isset($_SESSION['signup_error'] ))
    { $signuperr = $_SESSION['signup_error'];
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$signuperr.'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
      </button></div>';
      unset($_SESSION['signup_error']);
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


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
