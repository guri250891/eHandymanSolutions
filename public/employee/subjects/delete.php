<?php

require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/employee/subjects/index.php'));
}
$id = $_GET['id'];

$subject = find_subject_by_id($id);

if(is_post_request()) {
    delete_subject($id);
    redirect_to(url_for('/employee/subjects/index.php'));
}
else{
  $subject = find_subject_by_id($id);
}

?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject delete">
    <h1>Delete Nav Item</h1>
    <p>Are you sure you want to delete this nav item?</p>
    <p class="item"><?php echo h($subject['menu_name']); ?></p>

    <form action="<?php echo url_for('/employee/subjects/delete.php?id=' . h(u($subject['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Nav Item" />
      </div>
    </form>
  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
