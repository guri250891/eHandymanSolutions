<?php
require_once('../../private/initialize.php');


if(is_post_request()){
  $userContactUs['customerName'] = $_POST['customerName'] ?? '';
  $userContactUs['customerEmail'] = $_POST['customerEmail'] ?? '';
  $userContactUs['customerContact'] = $_POST['customerContact'] ?? '';
  $userContactUs['customerSubject'] = $_POST['customerSubject'] ?? '';
  $userContactUs['customerMessage'] = $_POST['customerMessage'] ?? '';

  //if($user['user_type'] == 'user'){
    $result = insert_contact_us($userContactUs);
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
  $userContactUs = [];
  $userContactUs['customerName'] = '';
  $userContactUs['customerEmail'] = '';
  $userContactUs['customerContact'] = '';
  $userContactUs['customerSubject'] = '';
  $userContactUs['customerMessage'] = '';
}

?>

