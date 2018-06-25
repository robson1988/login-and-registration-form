<?php

session_start();
  if (!isset($_SESSION['loged_in'])) {
    header("Location: index.html");
    exit();
  } else {
    $_SESSION['log_out_success'] = "Log out successful!";
    header("Location: index.html");
    exit();
  }
