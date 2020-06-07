<?php require_once('../../private/initialize.php'); ?>


<?php require_login(); ?>


<?php $page_title = 'Employee Menu'; ?>

<?php include(SHARED_PATH . '/employee_header.php'); ?>
<div class="container">
	<div id="content" class="adminMain">
		<div id="main-menu">
			<h2>Main Menu</h2>
			<ul>
				<li><a href="<?php echo url_for('/employee/subjects/index.php');?>">Main Nav Items</a></li>
				<li><a href="<?php echo url_for('/employee/pages/index.php');?>">Sub Nav Items</a></li>
				<li><a href="<?php echo url_for('/employee/admins/index.php');?>">Admins</a></li>
				<li><a href="<?php echo url_for('/employee/users/index.php');?>">Users</a></li>
				<li><a href="<?php echo url_for('/employee/dealers/index.php');?>">Dealers</a></li>
				<li><a href="<?php echo url_for('/employee/requestedServices/showRequestedServices.php'); ?>">View Requested Services</a></li>
				<li><a href="<?php echo url_for('/employee/requestedServices/showDealerAssignedServices.php'); ?>">View Assigned Services</a></li>
				<li><a href="<?php echo url_for('/employee/requestedServices/show_contact_us_requests.php'); ?>">View Contact Us User Requests</a></li>
			</ul>
		</div>

	</div>
</div>

<?php include(SHARED_PATH . '/employee_footer.php'); ?>
		