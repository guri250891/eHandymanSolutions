<?php require_once('../../../private/initialize.php'); 
require_login();
?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$subject = find_subject_by_id($id);
?>

<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject show">

    <h1>Nav Item Name: <?php echo h($subject['menu_name']); ?></h1>

<div class="attributes">
  <dl>
    <dt>Menu Name</dt>
    <dd><?php echo h($subject['menu_name']); ?></dd>
  </dl>
  <dl>
    <dt>Position</dt>
    <dd><?php echo h($subject['position']); ?></dd>
  </dl>
  <dl>
    <dt>Visible</dt>
    <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
  </dl>
  <dl>
        <dt>Content</dt>
        <dd><?php echo h($subject['content']); ?></dd>
      </dl>
</div>


  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
