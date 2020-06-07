<?php

require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/employee/index.php'));
}
$id = $_GET['id'];

$booked_service = find_assigned_service_by_id($id);

if(is_post_request()) {
    delete_assigned_service($id);
    redirect_to(url_for('/employee/requestedServices/showRequestedServices.php'));
}
else{
  $booked_service = find_assigned_service_by_id($id);
}

?>

<?php $page_title = 'Delete Assigned Service'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/requestedServices/showRequestedServices.php'); ?>">&laquo; Back to List</a>

  <div class="subject delete">
    <h1>Delete Assigned Service</h1>
    <p>Are you sure you want to delete this assigned service?</p>
     <p class="item"><?php echo h($booked_service['dealer_name']); ?></p>
    <p class="item"><?php echo h($booked_service['service_sub_type']); ?></p>

    <form action="<?php echo url_for('/employee/requestedServices/deleteAssignedService.php?id=' . h(u($booked_service['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Assigned Service" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/employee_footer.php'); ?>
