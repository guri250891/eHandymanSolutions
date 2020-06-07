<?php require_once('../../../private/initialize.php'); ?>

<?php
	$contact_us_set = find_all_contact_us_requests();
?>

<?php $page_title = 'User Contact Us Requests'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">
  <div class="subjects listing">
    <a class="back-link" href="<?php echo url_for('/employee/index.php'); ?>">&laquo; Back to List</a>
    <h1>Contact Us Requests</h1>

    <p></p>

  	<table class="list">
  	  <tr>
		<th>ID</th>
		<th>Username</th>
		<th>Email</th>
		<th>Mobile</th>
		<th>Subject</th>
		<th>Message</th>
	</tr>

      <?php while($contact_us = mysqli_fetch_assoc($contact_us_set)) { ?>
        <tr>
          <td><?php echo h($contact_us['id']); ?></td>
          <td><?php echo h($contact_us['customerName']); ?></td>
          <td><?php echo h($contact_us['customerEmail']); ?></td>
          <td><?php echo h($contact_us['customerContact']); ?></td>
          <td><?php echo h($contact_us['customerSubject']); ?></td>
          <td colspan="3" rowspan="2"><?php echo h($contact_us['customerMessage']); ?></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($contact_us_set); ?>

  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>