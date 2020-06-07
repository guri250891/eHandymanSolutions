<?php
require_once('../../private/initialize.php');

require_login();

$id = $_SESSION['user_id']; // PHP > 7.0
$user = find_user_by_id($id);

?>

<?php $page_title = 'Show User Profile'; ?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div class="container userProfile">

	<div class="headerTitle">
			<h1>View your profile</h1>
	</div>
	
	<div class="userOuter">
		<div class="media">
  			<div class="media-left">
    			<img src="../images/page_assets/userProfile.jpg" class="media-object">
  			</div>
  			<div class="media-body">
    			<h4 class="media-heading">Username: <?php echo h($user['username']); ?></h4>
    			<ul>
    				<li>First Name: <?php echo h($user['first_name']); ?></li>
    				<li>Last Name: <?php echo h($user['last_name']); ?></li>
    				<li>Email: <?php echo h($user['email']); ?></li>
    				<li>Mobile: <?php echo h($user['mobile']); ?></li>
    				<li>Address: <?php echo h($user['address']); ?></li>
    			</ul>
    			<a href="<?php echo url_for('/userArea/editUserProfile.php?id=' . h(u($user['id']))); ?>" class="updateUserProfile">Update Profile</a>
  			</div>
		</div>
	</div>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>