<?php
  include_once 'includes/header.php';
?>
<title> Forgot Password </title>
</head>
<body>
  <div class="reset d-flex ">
    <div class="row">
      <div class="sign_in_form">
        <form action="forgotPass.php" method="POST">
          <h2 class="header">Reset your Password</h2>
          <input class="sign" type="text" name="us_name" placeholder="Email Adress" required>
          <button type="submit" name="us_submit" class="btn btn-primary btn-block">Reset</button>
        </form>
      </div>
</body>
