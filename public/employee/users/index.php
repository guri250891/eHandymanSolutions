<?php

require_once('../../../private/initialize.php');

require_login();

$user_set = find_all_users();

?>

<?php $page_title = 'Users'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">
  <div class="admins listing">
    <h1>Users</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/employee/users/new.php'); ?>">Create New User</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th>Username</th>
        <th>Mobile</th>
        <th>Address</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php while($user = mysqli_fetch_assoc($user_set)) { ?>
        <tr>
          <td><?php echo h($user['id']); ?></td>
          <td><?php echo h($user['first_name']); ?></td>
          <td><?php echo h($user['last_name']); ?></td>
          <td><?php echo h($user['email']); ?></td>
          <td><?php echo h($user['username']); ?></td>
          <td><?php echo h($user['mobile']); ?></td>
          <td><?php echo h($user['address']); ?></td>
          <td><a class="action" href="<?php echo url_for('/employee/users/show.php?id=' . h(u($user['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/employee/users/edit.php?id=' . h(u($user['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/employee/users/delete.php?id=' . h(u($user['id']))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

    <?php
      mysqli_free_result($user_set);
    ?>
  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
