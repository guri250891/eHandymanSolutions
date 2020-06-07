<?php require_once('../../private/initialize.php'); ?>

<?php require_login(); ?>


<?php $page_title = 'Handyman Menu'; ?>

<?php include(SHARED_PATH . '/dealer_header.php'); ?>
	
	<div class="container">
	<div id="content">
		<div id="main-menu">
			<h2>Main Menu</h2>
			<ul>
				<li><a href="<?php echo url_for('/dealersArea/showAssignedServices.php'); ?>">Show Assigned Services</a></li>
				<li><a href="<?php echo url_for('/dealersArea/dealerProfile.php?id=' . $_SESSION['dealer_id']); ?>">View Your Profile</a></li>
			</ul>
		</div>

	</div>
</div>

<?php include(SHARED_PATH . '/dealer_footer.php'); ?>