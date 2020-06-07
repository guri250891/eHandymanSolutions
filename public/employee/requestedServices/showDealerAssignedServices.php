<?php require_once('../../../private/initialize.php'); ?>

<?php
  $assigned_service_set = find_all_assigned_services();
?>

<?php $page_title = 'User Requested Services'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">
  <div class="subjects listing">
    <a class="back-link" href="<?php echo url_for('/employee/index.php'); ?>">&laquo; Back to List</a>


    <h1 class="showAssignedServices">Assigned Services</h1>

    <p></p>

    <table class="list">
      <tr>
    <th>ID</th>
    <th>Dealer Name</th>
    <th>Service Sub Type</th>
    <th>Username</th>
    <th>Is Assigned</th>
    <th>Service Status</th>
    <th>&nbsp</th>
    <th>&nbsp</th>
  </tr>

      <?php while($assigned_service = mysqli_fetch_assoc($assigned_service_set)) { ?>
        <tr>
          <td><?php echo h($assigned_service['id']); ?></td>
          <td><?php echo h($assigned_service['dealer_name']); ?></td>
          <td><?php echo h($assigned_service['service_sub_type']); ?></td>
          <td><?php echo h($assigned_service['username']); ?></td>
          <td><?php if($assigned_service['isAssigned'] == 1) { echo "Yes"; } else { echo "No"; } ?></td>
          <td><?php echo h($assigned_service['serviceStatus']); ?></td>
          <td><a class="action" href="<?php echo url_for('/employee/requestedServices/updateUserRequestedServices.php?id=' . h(u($assigned_service['id']))); ?>">Update Service Status</a></td>
          <td><a class="action" href="<?php echo url_for('/employee/requestedServices/deleteAssignedService.php?id=' . h(u($assigned_service['id']))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

    <?php mysqli_free_result($assigned_service_set); ?>

  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>