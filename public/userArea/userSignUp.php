<?php
require_once('../../private/initialize.php');


if(is_post_request()){
  $user['user_type'] = 'user';
  $user['username'] = $_POST['username'] ?? '';
  $user['password'] = $_POST['password'] ?? '';
  $user['confirm_password'] = $_POST['confirm_password'] ?? '';
  $user['first_name'] = $_POST['first_name'] ?? '';
  $user['last_name'] = $_POST['last_name'] ?? '';
  $user['email'] = $_POST['email'] ?? '';
  $user['mobile'] = $_POST['mobile'] ?? '';
  $user['address'] = $_POST['address'] ?? '';

  //if($user['user_type'] == 'user'){
    $result = insert_user($user);
  //}
  //else if($user['user_type'] == 'dealer'){
  //    phpAlert("Please click Join as a dealer to signup as a dealer!!");
  //    redirect_to(url_for('index.php?subject_id=8'));
  //}

  if($result === true){
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('index.php?subject_id=6')); 
  }
  else{
    $errors = $result;
  }
}
else{
  $user = [];
  $user['user_type'] = '';
  $user['username'] = '';
  $user['password'] = '';
  $user['confirm_password'] = '';
  $user['first_name'] = '';
  $user['last_name'] = '';
  $user['email'] = '';
  $user['mobile'] = '';
  $user['address'] = '';
}

?>

