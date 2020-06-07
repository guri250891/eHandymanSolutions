<?php require_once('../../../private/initialize.php'); 

require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/employee/requestedServices/showRequestedServices.php'));
}
$id = $_GET['id'];

?>

<?php

$booked_service = find_requested_service_by_id($id);

$dealer_set = find_dealers_by_service_sub_type($booked_service['service_sub_type']);

if(is_post_request()) {

 $service_assign = [];
  $service_assign['dealer_name'] = $_POST['dealer_name'] ?? '';
  $service_assign['service_sub_type'] = $_POST['service_sub_type'] ?? '';
  $service_assign['username'] = $_POST['username'] ?? '';
  $service_assign['booking_date'] = $_POST['booking_date'] ?? '';
  $service_assign['service_assigning_date'] = $_POST['service_assigning_date'] ?? '';
  $service_assign['mobile'] = $_POST['mobile'] ?? '';
  $service_assign['address'] = $_POST['address'] ?? '';
  $service_assign['instructions'] = $_POST['instructions'] ?? '';
  $service_assign['isAssigned'] = $_POST['isAssigned'] ?? '';
  $service_assign['serviceStatus'] = 'Pending';
  $service_assign['service_id'] = $booked_service['id'] ?? '';

  $result = insert_assignedService($service_assign);
  //echo $result;
  //update_requested_service_assign;
  if($result === true){
    update_dealer_availability($service_assign['dealer_name']);
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/employee/requestedServices/showRequestedServices.php'));
  }
  else{
    $errors = $result;
  }
}
else{
  $service_assign = [];
  $service_assign['dealer_name'] = '';
  $service_assign['service_sub_type'] = '';
  $service_assign['username'] = '';
  $service_assign['booking_date'] = '';
  $service_assign['service_assigning_date'] = '';
  $service_assign['mobile'] = '';
  $service_assign['address'] = '';
  $service_assign['instructions'] = '';
  $service_assign['isAssigned'] = '';
  $service_assign['serviceStatus'] = '';
  $service_assign['service_id'] = '';

}


?>

<?php $page_title = 'Assign Requested Services'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>


<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/requestedServices/showRequestedServices.php'); ?>">&laquo; Back to List</a>

  <div class="page new">
    <h1>Assign Service To Handyman</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employee/requestedServices/assignRequestedServices.php?id=' . h(u($booked_service['id']))); ?>" method="post">
      <dl>
        <dt>Handyman Service Type</dt>
        <dd>
          <input type="text" name="service_sub_type" value="<?php echo h($booked_service['service_sub_type']); ?>" readOnly />
          
        </dd>
        <dd>
          <select name="dealer_name">
          	<option>Select Handyman</option>
          <?php
                while($dealer = mysqli_fetch_assoc($dealer_set)) {
              echo "<option value=\"" . h($dealer['username']) . "\"";
              echo ">" . h($dealer['username']) . "</option>";
            }
              mysqli_free_result($dealer_set);
            
            
          ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Service Assigning Date</dt>
          <dd><input type="date" name="service_assigning_date" /></dd>
      </dl>
      
      
      <dl>
        <dt>Customer Name:</dt>
          <dd><input type="text" name="username" value="<?php echo h($booked_service['username']); ?>" readOnly /></dd>
      </dl>
      <dl>
        <dt>Customer Contact No.</dt>
          <dd><input type="text" name="mobile" value="<?php echo h($booked_service['mobile']); ?>" readOnly /></dd>
      </dl>
      <dl>
        <dt>Customer Address</dt>
          <dd><input type="text" name="address" value="<?php echo h($booked_service['address']); ?>" readOnly /></dd>
      </dl>
      <dl>
        <dt>Service Booking Date</dt>
          <dd><input type="text" name="booking_date" value="<?php echo h($booked_service['booking_date']); ?>" readOnly /></dd>
      </dl>
      <dl>
        <dt>Requested Service Name:</dt>
        <dd><input type="text" name="service_sub_type" value="<?php echo h($booked_service['service_sub_type']); ?>" readOnly /></dd>
      </dl>
      <dl>
        <dt>Special Instructions by Customer</dt>
        	<dd>
        		<textarea name="instructions" cols="40" rows="7" readonly><?php echo h($booked_service['instructions']); ?></textarea>
          	</dd>
      </dl>
      <dl>
        <dt>Assign Requested Service To Handyman</dt>
        <dd>
          <input type="hidden" name="isAssigned" value="0" />
          <input type="checkbox" name="isAssigned" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Assign Requested Service" />
      </div>
    </form>

  </div>

</div>
</div>

<?php include(SHARED_PATH . '/employee_footer.php'); ?>