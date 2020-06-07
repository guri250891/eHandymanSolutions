<?php require_once('../../../private/initialize.php'); 
require_login();
?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$page = find_page_by_id($id);

?>

<?php $page_title = 'Show Sub Nav Item'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page show">

    <h1>Sub Nav Item Name: <?php echo h($page['menu_name']); ?></h1>

    <div class="attributes">
      <?php $subject = find_subject_by_id($page['subject_id']); ?>
      <dl>
        <dt>Main Nav Item</dt>
        <dd><?php echo h($subject['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($page['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($page['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd><?php echo h($page['content']); ?></dd>
      </dl>
    </div>

  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
