<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!--Font Awesome CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('/stylesheets/all.css'); ?>" media="all" />
	<!--Fonts-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo url_for('/stylesheets/bootstrap.min.css'); ?>" />
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <!--Handyman CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('/stylesheets/style.css'); ?>" media="all" />

    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

    <title>Handyman Solutions <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
  </head>
  <body>
    	<!--Header HTML Starts-->
    	<header>
    		<article class="topHeader">
                <div class="container">
    			     <div class="row topInfo">
    				    <div class="col-md-6 left">
                            <a href="homepage.php"><span><i class="fas fa-phone-alt"></i></span>1112229999</a>
                            <a href="homepage.php"><span><i class="fas fa-envelope"></i></span>handymansolutions@outlook.com</a>
    				    </div>
    				    <div class="col-md-6 right" id="right">
                            <h5>Welcome User <?php echo $_SESSION['username'] ?? ''; ?>!</h5>
                            <a id="joinDealer" href="/testProject/public/index.php?subject_id=8"><span><i class="fas fa-sign-in-alt"></i></span>Join As A Dealer</a>
    				    </div>
    			     </div>
               </div>
    		</article>
    		<article class="midHeader">
                <div class="container">
    			     <div class="row midInfo">
    				    <div class="col-md-3 midLeft">
                            <a href="<?php echo url_for('/index.php?subject_id=1'); ?> ">E-HandyMan<br/>Solutions</a>
    				    </div>
                        <div class="col-md-9 customnav" id="topNav">
                            <?php include(SHARED_PATH . '/public_navigation.php'); ?>
                            <a href="javascript:void(0);" class="icon" id="icon"><i class="fa fa-bars"></i></a>
                        </div>
    			     </div>
    			</div>
    		</article>
    		
    	</header>
      <!--Header HTML Ends-->