<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'Dealer Assigned Services'; ?>

<?php require_login(); ?>

<?php include(SHARED_PATH . '/dealer_header.php'); ?>
<?php

  $dealer_name = find_dealer_by_username($_SESSION['dealer_name']);
?>

<?php


   if($_SESSION['dealer_name'] == $dealer_name['username']){
      $assigned_service = find_assigned_service_by_dealerName($_SESSION['dealer_name']);
   }

?>

<div class="container">
<div id="content">
  <div class="subjects listing">
    <h1>Assigned Services</h1>

    <a class="back-link" href="<?php echo url_for('/dealersArea/index.php'); ?>">&laquo; Back to List</a>

    <p></p>

  	<table class="list">
  	  <tr>
		<th>ID</th>
    <th>Dealer Name</th>
    <th>Booked Service Name</th>
		<th>Username</th>
		<th>Date of Booking</th>
		<th>Date of Assigning</th>
		<th>Mobile No.</th>
		<th>&nbsp</th>
	</tr>

      
        <tr>
          <td><?php echo h($assigned_service['id']); ?></td>
          <td><?php echo h($assigned_service['dealer_name']); ?></td>
          <td><?php echo h($assigned_service['service_sub_type']); ?></td>
          <td><?php echo h($assigned_service['username']); ?></td>
          <td><?php echo h($assigned_service['booking_date']); ?></td>
          <td><?php echo h($assigned_service['service_assigning_date']); ?></td>
          <td><?php echo h($assigned_service['mobile']); ?></td>
          <td><a class="action" href="<?php echo url_for('/dealersArea/update_service_status.php?id=' . h(u($assigned_service['id']))); ?>">Update Service Status</a></td>
    	  </tr>
      
  	</table>

    

  </div>
</div>
</div>
<?php include(SHARED_PATH . '/dealer_footer.php'); ?>