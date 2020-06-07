<?php require_once('../../../private/initialize.php'); ?>
<?php
require_login();
$dealer_set = find_all_dealers();
?>
<?php $page_title = 'Handyman'; ?>

<?php include(SHARED_PATH . '/employee_header.php'); ?>
<div class="container">
	<div id="content">
  		<div class="admins listing">
    		<h1>Handymans List</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/employee/dealers/new.php'); ?>">Create New Handyman</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th>Username</th>
        <th>Mobile</th>
        <th>Hourly Rate</th>
        <th>Service Sub Type</th>
        <th>Available</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php while($dealer = mysqli_fetch_assoc($dealer_set)) { ?>
        <tr>
          <td><?php echo h($dealer['id']); ?></td>
          <td><?php echo h($dealer['first_name']); ?></td>
          <td><?php echo h($dealer['last_name']); ?></td>
          <td><?php echo h($dealer['email']); ?></td>
          <td><?php echo h($dealer['username']); ?></td>
          <td><?php echo h($dealer['mobile']); ?></td>
          <td><?php echo h($dealer['hourlyRate']); ?></td>
          <td><?php echo h($dealer['service_sub_type']); ?></td>
          <td><?php if($dealer['available'] == 1) echo "Yes"; else {echo "No";} ?></td>
          <td><a class="action" href="<?php echo url_for('/employee/dealers/show.php?id=' . h(u($dealer['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/employee/dealers/edit.php?id=' . h(u($dealer['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/employee/dealers/delete.php?id=' . h(u($dealer['id']))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

    <?php
      mysqli_free_result($dealer_set);
    ?>
  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>