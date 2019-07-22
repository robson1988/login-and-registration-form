<?php

session_start();
  if (!isset($_SESSION['loged_in'])) {
    header("Location: index.php");
    exit();
  } else {
    session_unset($_SESSION['loged_in']);
    $_SESSION['msg_success'] = "Log out successful!";
    header("Location: index.php");
    exit();
  }
