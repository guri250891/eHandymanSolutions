<?php

require_once('../../../private/initialize.php');

require_login();

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$dealer = find_dealer_by_id($id);

?>

<?php $page_title = 'Show Handyman'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>


<div class="container">
<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/dealers/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin show">

    <h1>Handyman Name: <?php echo h($dealer['username']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($dealer['first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($dealer['last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($dealer['email']); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($dealer['username']); ?></dd>
      </dl>
      <dl>
        <dt>Mobile</dt>
        <dd><?php echo h($dealer['mobile']); ?></dd>
      </dl>
      <dl>
        <dt>Address</dt>
        <dd><?php echo h($dealer['address']); ?></dd>
      </dl>
      <dl>
        <dt>Hourly Rate</dt>
        <dd><?php echo h($dealer['hourlyRate']); ?></dd>
      </dl>
      <dl>
        <dt>Main Service Type</dt>
        <dd><?php echo h($dealer['service_type']); ?></dd>
      </dl>
      <dl>
        <dt>Service Sub Category Type</dt>
        <dd><?php echo h($dealer['service_sub_type']); ?></dd>
      </dl>
      <dl>
        <dt>Available</dt>
        <dd><?php if($dealer['available'] == 1) echo "Yes"; else {echo "No";} ?></dd>
      </dl>
    </div>

  </div>

</div>
</div>
<?php include(SHARED_PATH . '/employee_footer.php'); ?>