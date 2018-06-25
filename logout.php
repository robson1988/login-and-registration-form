<?php

session_start();
  if (!isset($_SESSION['loged_in'])) {
    header("Location: index.php");
    exit();
  } else {
    $_SESSION['log_out_success'] = "Log out successful!";
    header("Location: index.php");
    exit();
  }
