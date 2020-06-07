<?php

require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/employee/index.php'));
}
$id = $_GET['id'];

$assignedService = find_assigned_service_by_id($id);

// if(is_post_request()) {
//   $updated_service = [];
//   $updated_service['id'] = $id;
//   $dealer['username'] = $_POST['username'] ?? '';
//   $dealer['password'] = $_POST['password'] ?? '';
//   $dealer['confirm_password'] = $_POST['confirm_password'] ?? '';
//   $dealer['first_name'] = $_POST['first_name'] ?? '';
//   $dealer['last_name'] = $_POST['last_name'] ?? '';
//   $dealer['email'] = $_POST['email'] ?? '';
//   $dealer['mobile'] = $_POST['mobile'] ?? '';
//   $dealer['service_type'] = $_POST['service_type'] ?? '';
//   $dealer['hourlyRate'] = $_POST['hourlyRate'] ?? '';
//   $dealer['address'] = $_POST['address'] ?? '';
//   $dealer['city'] = $_POST['city'] ?? '';
//   $dealer['available'] = $_POST['available'] ?? '';
  

//   $result = update_dealer($updated_service);
//   if($result === true) {
//     redirect_to(url_for('/dealersArea/dealerProfile.php'));
//   } else {
//     $errors = $result;
//   }
// } else {
  $updated_service = find_updated_service_by_id($assignedService['service_id']);
//}

?>

<?php $page_title = 'Edit Updated Service'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>
<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/requestedServices/showDealerAssignedServices.php'); ?>">&laquo; Back to List</a>

  <div class="admin edit">
    <h1>Updated Service Status to User</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employee/requestedServices/updateUserRequestedServices.php?id=' . h(u($id))); ?>" method="post">
      <div class="dtails">
      <p>Dealer Details</p>
      <dl>
        <dt>Service assigned to Dealer:</dt>
        <dd><input type="text" name="dealer_name" value="<?php echo h($updated_service['dealer_name']); ?>" readonly/></dd>
      </dl>
      <dl>
        <dt>Service Type Requested:</dt>
        <dd><input type="text" name="service_sub_type" value="<?php echo h($updated_service['service_sub_type']); ?>" readonly/></dd>
      </dl>
      <p>User Details</p>
      <dl>
        <dt>User First Name:</dt>
        <dd><input type="text" name="user_first_name" value="<?php echo h($updated_service['user_first_name']); ?>" readonly/></dd>
      </dl>
      <dl>
        <dt>User Last Name:</dt>
        <dd><input type="text" name="user_last_name" value="<?php echo h($updated_service['user_last_name']); ?>" readonly/></dd>
      </dl>
    </div>
      <div class="updateDetails">
      <p>Payment Details</p>
      <dl>
        <dt>Service Status:</dt>
        <dd><input type="text" name="serviceStatus" value="<?php echo h($updated_service['serviceStatus']); ?>" readonly/></dd>
      </dl>
      <dl>
        <dt>Total Hours Worked by Handyman:</dt>
        <dd><input type="text" name="numHoursWorked" value="<?php echo h($updated_service['numHoursWorked']); ?>" readonly/></dd>
      </dl>
      <dl>
        <dt>Total Accessories Charges:</dt>
        <dd><input type="text" name="accessoriesCharges" value="<?php echo h($updated_service['accessoriesCharges']); ?>" readonly/></dd>
      </dl>
      <dl>
        <dt>Total Payment:</dt>
        <dd><input type="text" name="totalPayment" value="<?php echo h($updated_service['totalPayment']); ?>" readonly/></dd>
      </dl>
      <br />
      <div id="operations">
        <input type="submit" value="Update Service Details To User" />
      </div>
    </div>
    </form>

  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
