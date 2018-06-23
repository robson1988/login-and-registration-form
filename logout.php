<?php

session_start();
  if (!isset($_SESSION['signed'])) {
    header("Location: index.php");
    exit();
  } else {
    $_SESSION['sign_out_success'] = "Sign out successful!";
    header("Location: index.php");
    exit();
  }
