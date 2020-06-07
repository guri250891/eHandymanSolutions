<?php

require_once('../../../private/initialize.php');

require_login();

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$user = find_user_by_id($id);

?>

<?php $page_title = 'Show User'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin show">

    <h1>User: <?php echo h($user['username']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($user['first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($user['last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($user['email']); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($user['username']); ?></dd>
      </dl>
      <dl>
        <dt>Mobile</dt>
        <dd><?php echo h($user['mobile']); ?></dd>
      </dl>
      <dl>
        <dt>Address</dt>
        <dd><?php echo h($user['address']); ?></dd>
      </dl>
    </div>

  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>