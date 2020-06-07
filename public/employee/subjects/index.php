<?php require_once('../../../private/initialize.php'); 
require_login();
?>

<?php

  $subject_set = find_all_subjects();

?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">
  <div class="subjects listing">
    <h1>Main Nav</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/employee/subjects/new.php'); ?>">Create New Nav Item</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($subject = mysqli_fetch_assoc($subject_set)) { ?>
        <tr>
          <td><?php echo h($subject['id']); ?></td>
          <td><?php echo h($subject['position']); ?></td>
          <td><?php echo $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($subject['menu_name']); ?></td>
          <td><a class="action" href="<?php echo url_for('/employee/subjects/show.php?id=' . h(u($subject['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/employee/subjects/edit.php?id=' . h(u($subject['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('employee/subjects/delete.php?id=' . h(u($subject['id']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($subject_set); ?>

  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>