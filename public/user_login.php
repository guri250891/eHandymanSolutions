<?php
require_once('../private/initialize.php');

$errors = [];
$user_type = '';
$username = '';
$password = '';

if(is_post_request()) {

  $user_type = $_POST['user_type'] ?? '';
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    // Using one variable ensures that msg is the same
    $login_failure_msg = "Log in was unsuccessful.";

    if($_POST['user_type'] == 'admin'){

      $admin = find_admin_by_username($username);

        if(password_verify($password, $admin['hashed_password'])) {
        // password matches
        log_in_admin($admin);
        redirect_to(url_for('/employee/index.php'));
      } else {
        // username found, but password does not match
        $errors[] = $login_failure_msg;
      }
    }
    else if($_POST['user_type'] == 'user'){

      $user = find_user_by_username($username);

        if(password_verify($password, $user['hashed_password'])) {
        // password matches
        log_in_user($user);
        redirect_to(url_for('/index.php'));
      } else {
        // username found, but password does not match
        $errors[] = $login_failure_msg;
      }
    }
    else if($_POST['user_type'] == 'dealer'){

      $dealer = find_dealer_by_username($username);

        if(password_verify($password, $dealer['hashed_password'])) {
        // password matches
        log_in_dealer($dealer);
        redirect_to(url_for('/dealersArea/index.php'));
      } else {
        // username found, but password does not match
        $errors[] = $login_failure_msg;
      }
    }
 else {
      // no username found
      $errors[] = $login_failure_msg;
    }

  }

}

?>