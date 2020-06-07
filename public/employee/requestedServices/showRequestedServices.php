<?php require_once('../../../private/initialize.php'); ?>

<?php
	$booked_service_set = find_all_requested_services();
?>

<?php $page_title = 'User Requested Services'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">
  <div class="subjects listing">
    <a class="back-link" href="<?php echo url_for('/employee/index.php'); ?>">&laquo; Back to List</a>
    <h1>Requested Services</h1>

    <p></p>

  	<table class="list">
  	  <tr>
		<th>ID</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Booked Service Name</th>
		<th>Date of Booking</th>
		<th>Email ID</th>
		<th>Mobile No.</th>
		<th>&nbsp</th>
    <th>&nbsp</th>
	</tr>

      <?php while($booked_service = mysqli_fetch_assoc($booked_service_set)) { 
        if(!find_selected_assigned_services(h($booked_service['id']))){?>

        
        <tr>
          <td><?php echo h($booked_service['id']); ?></td>
          <td><?php echo h($booked_service['first_name']); ?></td>
          <td><?php echo h($booked_service['last_name']); ?></td>
          <td><?php echo h($booked_service['service_sub_type']); ?></td>
          <td><?php echo h($booked_service['booking_date']); ?></td>
          <td><?php echo h($booked_service['email']); ?></td>
          <td><?php echo h($booked_service['mobile']); ?></td>
          <td><a class="action" href="<?php echo url_for('/employee/requestedServices/assignRequestedServices.php?id=' . h(u($booked_service['id']))); ?>">Assign</a></td>
          <td><a class="action" href="<?php echo url_for('/employee/requestedServices/deleteRequestedService.php?id=' . h(u($booked_service['id']))); ?>">Delete</a></td>
    	  </tr>
      <?php }} ?>
  	</table>

    <?php mysqli_free_result($booked_service_set); ?>


  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>