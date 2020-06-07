<?php require_once('../../private/initialize.php'); 
require_login();
if(!isset($_SESSION['user_id'])) {
  redirect_to(url_for('/index.php?subject_id=6'));
}
$id = $_SESSION['user_id'];
?>

<?php

if(is_post_request()) {
  $requested_service['username'] = $_SESSION['username'] ?? '';
  $requested_service['first_name'] = $_SESSION['first_name'] ?? '';
  $requested_service['last_name'] = $_SESSION['last_name'] ?? '';
  $requested_service['service_sub_type'] = $_POST['service_name'];

  $requested_service['booking_date'] = $_POST['booking_date'] ?? '';
  $requested_service['email'] = $_POST['email'] ?? '';
  $requested_service['mobile'] = $_POST['mobile_number'] ?? '';
  $requested_service['address'] = $_POST['address'] ?? '';
  $requested_service['instructions'] = $_POST['instructions'] ?? '';  

  $result = insert_requestedService($requested_service);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'Service requested successfully.';
    redirect_to(url_for('/index.php'));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $requested_service = [];
  $requested_service['username'] = '';
  $requested_service['first_name'] = '';
  $requested_service['last_name'] = '';
  $requested_service['service_sub_type'] = '';
  $requested_service['booking_date'] = '';
  $requested_service['email'] = '';
  $requested_service['mobile'] = '';
  $requested_service['address'] = '';
  $requested_service['instructions'] = '';
}


?>
