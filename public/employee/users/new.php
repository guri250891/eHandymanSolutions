<?php

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {
  $user['user_type'] = 'user';
  $user['username'] = $_POST['username'] ?? '';
  $user['password'] = $_POST['password'] ?? '';
  $user['confirm_password'] = $_POST['confirm_password'] ?? '';
  $user['first_name'] = $_POST['first_name'] ?? '';
  $user['last_name'] = $_POST['last_name'] ?? '';
  $user['email'] = $_POST['email'] ?? '';
  $user['mobile'] = $_POST['mobile'] ?? '';
  $user['address'] = $_POST['address'] ?? '';

  $result = insert_user($user);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'User created.';
    redirect_to(url_for('/employee/users/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $user['user_type'] ='';
  $user['username'] = '';
  $user['password'] = '';
  $user['confirm_password'] = '';
  $user['first_name'] = '';
  $user['last_name'] = '';
  $user['email'] = '';
  $user['mobile'] = '';
  $user['address'] = '';
}

?>

<?php $page_title = 'Create User'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin new">
    <h1>Create User</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employee/users/new.php'); ?>" method="post">
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
        <dt>Email </dt>
        <dd><input type="text" name="email" value="<?php echo h($user['email']); ?>" /><br /></dd>
      </dl>
      <dl>
        <dt>Mobile </dt>
        <dd><input type="text" name="mobile" value="<?php echo h($user['mobile']); ?>" /><br /></dd>
      </dl>
      <dl>
        <dt>Address </dt>
        <dd><input type="text" name="address" value="<?php echo h($user['address']); ?>" /><br /></dd>
      </dl>
      <br />

      <div id="operations">
        <input type="submit" value="Create User" />
      </div>
    </form>

  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
