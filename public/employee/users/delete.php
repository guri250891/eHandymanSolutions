<?php

require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/employee/users/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $result = delete_user($id);
  $_SESSION['message'] = 'User deleted.';
  redirect_to(url_for('/employee/users/index.php'));
} else {
  $user = find_user_by_id($id);
}

?>

<?php $page_title = 'Delete User'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin delete">
    <h1>Delete User</h1>
    <p>Are you sure you want to delete this user?</p>
    <p class="item"><?php echo h($user['username']); ?></p>

    <form action="<?php echo url_for('/employee/users/delete.php?id=' . h(u($user['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete User" />
      </div>
    </form>
  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
