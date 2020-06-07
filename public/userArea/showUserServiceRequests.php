<?php
require_once('../../private/initialize.php');

require_login();

$userName = $_SESSION['username']; // PHP > 7.0
//$requestedService = find_requestedService_by_username($userName);

?>

<?php $page_title = 'Show User Requested Services'; ?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div class="container userServiceRequests">
	
	<div class="headerTitle">
			<h1>View your service requests</h1>
	</div>

	<div class="outerRequestsServices">
		 <?php
                $requestedService_set = find_requestedService_by_username($userName);
                while($requestedService = mysqli_fetch_assoc($requestedService_set)) {
              echo "<div class='serviceOuter'><ul><li>Username: " . h($requestedService['username']) . "</li>
              		<li>Requested Service Type: " . h($requestedService['service_sub_type']) . "</li>
              		<li>Booking Date: " . h($requestedService['booking_date']) . "</li>
              		<li class='checkStatus'><a href=" . url_for('/userArea/checkServiceStatus.php?id=' . h(u($requestedService['id']))) . ">Check Status</a></li>
              <ul></div>";
            }
              mysqli_free_result($requestedService_set);
            
            
          ?>
	</div>

</div>



<?php include(SHARED_PATH . '/public_footer.php'); ?>