<?php
require_once('../../private/initialize.php');


if(is_post_request()){
  $dealer['user_type'] = 'dealer';
  $dealer['username'] = $_POST['username'] ?? '';
  $dealer['password'] = $_POST['password'] ?? '';
  $dealer['confirm_password'] = $_POST['confirm_password'] ?? '';
  $dealer['first_name'] = $_POST['first_name'] ?? '';
  $dealer['last_name'] = $_POST['last_name'] ?? '';
  $dealer['email'] = $_POST['email'] ?? '';
  $dealer['mobile'] = $_POST['mobile'] ?? '';
  $dealer['service_type'] = $_POST['service_type'] ?? '';
  if($_POST['household_sub_type']){
      $dealer['service_sub_type'] = $_POST['household_sub_type'] ?? '';
  }
  else if($_POST['business_sub_type']){
      $dealer['service_sub_type'] = $_POST['business_sub_type'] ?? '';
  }
  $dealer['hourlyRate'] = $_POST['hourlyRate'] ?? '';
  $dealer['address'] = $_POST['address'] ?? '';
  $dealer['city'] = $_POST['city'] ?? '';
  $dealer['available'] = 1;

  //if($dealer['user_type'] == 'dealer'){
       $result = insert_dealer($dealer);
  //}
  //else if($dealer['user_type'] == 'user'){
  //   phpAlert("Please click Signup to signup as a user!!");
  //    redirect_to(url_for('index.php?subject_id=7'));
  //}

  if($result === true){
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/employee/dealers/dealers.php')); 
  }
  else{
    $errors = $result;
  }
}
else{
  $dealer = [];
  $dealer['user_type'] = '';
  $dealer['username'] = '';
  $dealer['password'] = '';
  $dealer['confirm_password'] = '';
  $dealer['first_name'] = '';
  $dealer['last_name'] = '';
  $dealer['email'] = '';
  $dealer['mobile'] = '';
  $dealer['service_type'] = '';
  $dealer['service_sub_type'] = '';
  $dealer['hourlyRate'] = '';
  $dealer['address'] = '';
  $dealer['city'] = '';
  $dealer['available'] = '';
}

?>

