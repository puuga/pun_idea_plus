<?php
// Start the session
session_start();

function isSignin() {
  return isset($_SESSION["user_is_signin"]) ? TRUE : FALSE;
}

function getUserEmail() {
  return $_SESSION["user_email"];
}

function getUserLevel() {
  return isset($_SESSION["user_level"]) ? $_SESSION["user_level"] : 1000;
}

function getCurrentUser() {
  $user = new stdClass();
  $user->name = $_SESSION["user_name"];
  $user->email = $_SESSION["user_email"];
  $user->password = $_SESSION["user_password"];
  $user->user_level = $_SESSION["user_level"];
  $user->user_level_name = $_SESSION["user_level"]=="0" ? "Admin" : "Normal";

  return $user;
}

function requireSignin($bool) {
  if ( $bool && !isSignin() ) {
    header("Location: sign_in_form.php?message=require signined");
    die();
  }
}

function requireLevel($level) {
  if ( getUserLevel() > $level ) {
    header("Location: sign_in_form.php?message=no permission");
    die();
  }
}

?>
