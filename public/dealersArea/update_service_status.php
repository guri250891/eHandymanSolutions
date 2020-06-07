<?php

require_once('../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/dealersArea/index.php'));
}
$id = $_GET['id'];

$assigned_service = find_assigned_service_by_id($id);

$requested_service = find_requested_service_by_service_type($assigned_service['service_sub_type']);

if(is_post_request()) {
  $updated_service['user_first_name'] = $requested_service['first_name'] ?? '';
  $updated_service['user_last_name'] = $requested_service['last_name'] ?? '';
  $updated_service['dealer_name'] = $assigned_service['dealer_name'] ?? '';
  $updated_service['service_sub_type'] = $assigned_service['service_sub_type'] ?? '';
  $updated_service['service_assigning_date'] = $assigned_service['service_assigning_date'] ?? '';
  $updated_service['serviceStatus'] = $_POST['serviceStatus'] ?? '';
  $updated_service['jobDescription'] = $_POST['jobDescription'] ?? '';
  $updated_service['numHoursWorked'] = $_POST['numHoursWorked'] ?? '';
  $updated_service['hourlyRate'] = $_POST['hourlyRate'] ?? '';
  $updated_service['accessoriesCharges'] = $_POST['accessoriesCharges'] ?? '';
  $updated_service['totalPayment'] = $_POST['totalPayment'] ?? '';
  $updated_service['paymentReceived'] = $_POST['paymentReceived'] ?? '';
  $updated_service['service_id'] = $assigned_service['service_id'] ?? '';  

  $result = insert_updated_service($updated_service);
  if($result === true) {
    update_sercvice_status($updated_service['serviceStatus'], $updated_service['service_id']);
    $new_id = mysqli_insert_id($db);
    echo '<script>$(document).ready(function() { alert("Inserted"); });</script>';
    redirect_to(url_for('/dealersArea/index.php'));
  } else {
    $errors = $result;
    //var_dump($errors);
  }

} else {
  // display the blank form
  $updated_service = [];
  $updated_service['user_first_name'] = '';
  $updated_service['user_last_name'] = '';
  $updated_service['dealer_name'] = '';
  $updated_service['service_sub_type'] = '';
  $updated_service['service_assigning_date'] = '';
  $updated_service['serviceStatus'] = '';
  $updated_service['jobDescription'] = '';
  $updated_service['numHoursWorked'] = '';
  $updated_service['hourlyRate'] = '';
  $updated_service['accessoriesCharges'] = '';
  $updated_service['totalPayment'] = '';
  $updated_service['paymentReceived'] = '';
  $updated_service['service_id'] = '';
}

?>

<?php $page_title = 'Update Service Status'; ?>
<?php include(SHARED_PATH . '/dealer_header.php'); ?>

<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/dealersArea/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin edit">
    <h1>Update Service Status</h1>

    <?php echo display_errors($errors); ?>

    <?php $dealer_details = find_dealer_by_username($_SESSION['dealer_name']);
    ?>
    <form action="<?php echo url_for('/dealersArea/update_service_status.php?id=' . h(u($id))); ?>" method="post">
      <div class="dtails">
      <p>Dealer Details</p>
      <dl>
        <dt>Service assigned to Dealer:</dt>
        <dd><input type="text" name="dealer_name" value="<?php echo h($assigned_service['dealer_name']); ?>" readonly/></dd>
      </dl>
      <dl>
        <dt>Service Name:</dt>
        <dd><input type="text" name="service_sub_type" value="<?php echo h($assigned_service['service_sub_type']); ?>" readonly/></dd>
      </dl>
      <dl>
        <dt>Service Assigning Date:</dt>
        <dd><input type="text" name="service_assigning_date" value="<?php echo h($assigned_service['service_assigning_date']); ?>" readonly/></dd>
      </dl>
      <p>User Details</p>
      <dl>
        <dt>Booking Date:</dt>
        <dd><input type="text" name="booking_date" value="<?php echo h($assigned_service['booking_date']); ?>" readonly/></dd>
      </dl>
      <dl>
        <dt>User First Name:</dt>
        <dd><input type="text" name="first_name" value="<?php echo h($requested_service['first_name']); ?>" readonly/></dd>
      </dl>
      <dl>
        <dt>User Last Name:</dt>
        <dd><input type="text" name="last_name" value="<?php echo h($requested_service['last_name']); ?>" readonly/></dd>
      </dl>
      <dl>
        <dt>User Instructions:</dt>
        <dd><textarea name="content" cols="20" rows="8" readonly><?php echo h($assigned_service['instructions']); ?></textarea></dd>
      </dl>
    </div>
      <div class="updateDetails">
      <p>Update Service Details</p>
      <dl>
        <dt>Service Status:</dt>
        <dd>
          <select id="serviceStatus" class="serviceStatus" name="serviceStatus">
            <option>Select Service Status</option>
            <option value="In Progress">In Progress</option>
            <option value="Complete">Complete</option>
          </select>
          </dd>
      </dl>
      <dl>
        <dt>Job Description:</dt>
        <dd><textarea name="jobDescription" rows="7" cols="21"></textarea></dd>
      </dl>
      <dl id="accessories">
        <dt>Accessories Charges:</dt>
        <dd><input id="accessoriesCharges" type="text" name="accessoriesCharges" value="<?php echo h($updated_service['accessoriesCharges']); ?>" /></dd>
      </dl>
      <dl id="numHoursWorked">
        <dt>No. of Hours Worked:</dt>
        <dd><input id="numHours" type="text" name="numHoursWorked" value="<?php echo h($updated_service['numHoursWorked']); ?>" /></dd>
      </dl>
      <dl id="hourlyRate">
        <dt>Hourly Rate</dt>
        <dd><input id="rate" type="text" name="hourlyRate" value="<?php echo h($dealer_details['hourlyRate']); ?>" readonly /></dd>
      </dl>
      <dl id="totalPayment">
        <dt>Total Payment</dt>
        <dd><input id="payment" type="text" name="totalPayment" value="<?php echo h($updated_service['totalPayment']); ?>" readonly /></dd>
      </dl>
      <dl id="paymentReceived">
        <dt>Payment Received</dt>
        <dd><input type="hidden" name="paymentReceived" value="0" />
          <input type="checkbox" name="paymentReceived" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Update Service Status" />
      </div>
    </div>
    </form>

  </div>

  <script>
      $(document).ready(function() {
          $("#serviceStatus").change(function(){
              //alert(this.value);
              if(this.value == "In Progress"){
                  $("#numHoursWorked").css({
                    "display": "none"
                  });
                  $("#accessoriesCharges").css({
                    "display": "none"
                  });
                  $("#hourlyRate").css({
                    "display": "none"
                  });
                  $("#totalPayment").css({
                    "display": "none"
                  });
                  $("#paymentReceived").css({
                    "display": "none"
                  });
              }
              else if(this.value == "Complete"){
                  $("#numHoursWorked").css({
                    "display": "block"
                  });
                  $("#accessoriesCharges").css({
                    "display": "block"
                  });
                  $("#hourlyRate").css({
                    "display": "block"
                  });
                  $("#totalPayment").css({
                    "display": "block"
                  });
                  $("#paymentReceived").css({
                    "display": "block"
                  });
              }
          });
                  var totalPayment;
                  var tax = 0.12;
                  var rate = $("#rate").val();
                  var totalTax;
                  var total;
                  //var payment = $("#payment").val();
                  $("#numHours").change(function(){
                      var accessories = $("#accessoriesCharges").val();
                      totalPayment = ((this.value * parseFloat(rate)) + parseFloat(accessories));
                      totalTax = (totalPayment) * tax;
                      total = totalPayment + totalTax;
                      $("#payment").val(total.toFixed(2));
                  });

      });
  </script>

</div>
</div>
<?php include(SHARED_PATH . '/dealer_footer.php'); ?>
