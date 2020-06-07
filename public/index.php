<?php require_once('../private/initialize.php'); ?>

<?php
	if(isset($_GET['subject_id'])){
		$subject_id = $_GET['subject_id'];
			$subject = find_subject_by_id($subject_id);
			if(!$subject){
			redirect_to(url_for('/index.php'));
		}
	}
	else{
			if(isset($_GET['id'])) {
  				$page_id = $_GET['id'];
  				$page = find_page_by_id($page_id);
  				if(!$page) {
    				redirect_to(url_for('/index.php'));
  				}
  				$subject_id = $page['subject_id'];
} elseif(isset($_GET['subject_id'])) {
  $subject_id = $_GET['subject_id'];

  $page_set = find_pages_by_subject_id($subject_id);
  $page = mysqli_fetch_assoc($page_set); // first page
  mysqli_free_result($page_set);
  if(!$page) {
    redirect_to(url_for('/index.php'));
  }
  $page_id = $page['id'];
} else {
  // nothing selected; show the homepage
}
	}


?>

<?php include(SHARED_PATH . '/public_header.php'); 
?>

<div id="main" class="<?php if(isset($_GET['subject_id']) == 1) {$str = strtolower($subject['menu_name']); echo preg_replace('/\s+/', '', $str); } ?>">
	<div id="page">

		<!-- <div class="container customUserDetails">
			<div class="userDetails">
				<h1 class="loggedIn">User: <?php //echo $_SESSION['username'] ?? ''; ?></h1>
				<a class="logoutUser" href="userArea/user_logout.php">Logout User</a>
			</div>
		</div> -->

		

		<?php
		
		if(isset($subject)){
			//show the page from the database
			/**$allowed_tags = "<div><img><h1><h2><h3><h4><h5><h6><input><select><option><p><br><strong><ul><en><li><button><i><span><a><article><header><footer><hr><?php ?>";**/
			echo ($subject['content']);
		}
		else if(isset($page)) {
        	echo ($page['content']);

      } else {
        include(SHARED_PATH . '/static_homepage.php');
      }


		?>
		
	</div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>