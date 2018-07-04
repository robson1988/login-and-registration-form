<?php

session_start();
  if (!isset($_SESSION['loged_in'])) {
    header("Location: index.html");
    exit();
  } else {
    $_SESSION['msg_success'] = "Log out successful!";
    header("Location: index.html");
    exit();
  }
