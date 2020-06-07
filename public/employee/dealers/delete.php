<?php

require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/employee/dealers/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $result = delete_dealer($id);
  $_SESSION['message'] = 'Dealer deleted.';
  redirect_to(url_for('/employee/dealers/index.php'));
} else {
  $dealer = find_dealer_by_id($id);
}

?>

<?php $page_title = 'Delete Dealer'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>
<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/dealers/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin delete">
    <h1>Delete Dealer</h1>
    <p>Are you sure you want to delete this handyman?</p>
    <p class="item"><?php echo h($dealer['username']); ?></p>

    <form action="<?php echo url_for('/employee/dealers/delete.php?id=' . h(u($dealer['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Handyman" />
      </div>
    </form>
  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
