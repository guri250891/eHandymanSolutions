<?php

require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/employee/dealers/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $dealer = [];
  $dealer['id'] = $id;
  $dealer['user_type'] = 'dealer';
  $dealer['username'] = $_POST['username'] ?? '';
  $dealer['password'] = $_POST['password'] ?? '';
  $dealer['confirm_password'] = $_POST['confirm_password'] ?? '';
  $dealer['first_name'] = $_POST['first_name'] ?? '';
  $dealer['last_name'] = $_POST['last_name'] ?? '';
  $dealer['email'] = $_POST['email'] ?? '';
  $dealer['mobile'] = $_POST['mobile'] ?? '';
  $dealer['service_type'] = $_POST['service_type'] ?? '';
  $dealer['service_sub_type'] = $_POST['service_sub_type'] ?? '';
  $dealer['hourlyRate'] = $_POST['hourlyRate'] ?? '';
  $dealer['address'] = $_POST['address'] ?? '';
  $dealer['city'] = $_POST['city'] ?? '';
  $dealer['available'] = $_POST['available'] ?? '';

  $result = update_dealer($dealer);
  if($result === true) {
    $_SESSION['message'] = 'Dealer updated.';
    redirect_to(url_for('/employee/dealers/show.php?id=' . $id));
  } else {
    $errors = $result;
  }
} else {
  $dealer = find_dealer_by_id($id);
}

?>

<?php $page_title = 'Edit Handyman'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/dealers/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin edit">
    <h1>Edit Handyman</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employee/dealers/edit.php?id=' . h(u($id))); ?>" method="post">

      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="<?php echo h($dealer['username']); ?>" /></dd>
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
        <dd><input type="text" name="first_name" value="<?php echo h($dealer['first_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Last name</dt>
        <dd><input type="text" name="last_name" value="<?php echo h($dealer['last_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo h($dealer['email']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>Mobile</dt>
        <dd><input type="text" name="mobile" value="<?php echo h($dealer['mobile']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>Address</dt>
        <dd><input type="text" name="address" value="<?php echo h($dealer['address']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>City</dt>
        <dd><input type="text" name="city" value="<?php echo h($dealer['city']); ?>" /><br /></dd>
      </dl>
      <dl>
        <dt>Hourly Rate</dt>
        <dd><input type="text" name="hourlyRate" value="<?php echo h($dealer['hourlyRate']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>Available</dt>
        <dd>
          <input type="hidden" name="available" value="0" />
          <input type="checkbox" name="available" value="1"<?php if($dealer['available'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>

      <dl>
        <dt>Service Type</dt>
        <dd><input type="text" name="service_type" value="<?php echo h($dealer['service_type']); ?>" readonly /><br /></dd>
      </dl>

      <dl>
        <dt>Service Sub type</dt>
        <dd><input type="text" name="service_sub_type" value="<?php echo h($dealer['service_sub_type']); ?>" readonly /><br /></dd>
      </dl>

      
      <br />

      <div id="operations">
        <input type="submit" value="Edit Handyman" />
      </div>
    </form>

  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
