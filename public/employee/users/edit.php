<?php

require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/employee/users/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $user = [];
  $user['id'] = $id;
  $user['user_type'] = 'user';
  $user['username'] = $_POST['username'] ?? '';
  $user['password'] = $_POST['password'] ?? '';
  $user['confirm_password'] = $_POST['confirm_password'] ?? '';
  $user['first_name'] = $_POST['first_name'] ?? '';
  $user['last_name'] = $_POST['last_name'] ?? '';
  $user['email'] = $_POST['email'] ?? '';
  $user['mobile'] = $_POST['mobile'] ?? '';
  $user['address'] = $_POST['address'] ?? '';

  $result = update_user($user);
  if($result === true) {
    $_SESSION['message'] = 'User updated.';
    redirect_to(url_for('/employee/users/show.php?id=' . $id));
  } else {
    $errors = $result;
  }
} else {
  $user = find_user_by_id($id);
}

?>

<?php $page_title = 'Edit User'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin edit">
    <h1>Edit User</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employee/users/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="<?php echo h($user['username']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>
      </dl>

      <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd>
      </dl>
      <p>
        Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.
      </p>

      <dl>
        <dt>First name</dt>
        <dd><input type="text" name="first_name" value="<?php echo h($user['first_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Last name</dt>
        <dd><input type="text" name="last_name" value="<?php echo h($user['last_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo h($user['email']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>Mobile</dt>
        <dd><input type="text" name="mobile" value="<?php echo h($user['mobile']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>Address</dt>
        <dd><input type="text" name="address" value="<?php echo h($user['address']); ?>" /><br /></dd>
      </dl>

      <br />

      <div id="operations">
        <input type="submit" value="Edit User" />
      </div>
    </form>

  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
