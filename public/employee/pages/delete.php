<?php

require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_page($id);
  redirect_to(url_for('/employee/pages/index.php'));

} else {
  $page = find_page_by_id($id);
}

?>

<?php $page_title = 'Delete Sub Nav Item'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page delete">
    <h1>Delete Sub Nav Item</h1>
    <p>Are you sure you want to delete this sub nav item?</p>
    <p class="item">Sub Nav Item Name: <?php echo h($page['menu_name']); ?></p>

    <form action="<?php echo url_for('/employee/pages/delete.php?id=' . h(u($page['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Sub Nav Item" />
      </div>
    </form>
  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
