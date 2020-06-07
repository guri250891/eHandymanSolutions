<?php
	if(!isset($page_title)) { $page_title = 'Admin Area'; }
?>
<!doctype html>
<html lang="en">

	<head>
		<title>E-Handyman Solutions - <?php echo $page_title; ?></title>
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
	</head>

	<body class="employeeArea">
		
		<header>
    		<article class="topHeader">
                <div class="container">
    			     <div class="row topInfo">
    				    <div class="col-md-6 left">
                            <a href="homepage.php"><span><i class="fas fa-phone-alt"></i></span>1112229999</a>
                            <a href="homepage.php"><span><i class="fas fa-envelope"></i></span>handymansolutions@outlook.com</a>
    				    </div>
    				    <div class="col-md-6 right">
                            <h5>Admin Username: <?php echo $_SESSION['admin_name'] ?? ''; ?></h5>
    				    </div>
    			     </div>
               </div>
    		</article>
    		<article class="midHeader">
                <div class="container">
    			     <div class="row midInfo">
    				    <div class="col-md-3 midLeft">
                            <a href="<?php echo url_for('/employee/index.php'); ?> ">E-HandyMan<br/>Solutions</a>
    				    </div>
                        <div class="col-md-9 employeeNav">
                            <navigation>
								<ul>
									<li><a href="<?php echo url_for('/employee/index.php'); ?>">Admin Menu</a></li>
									<li><a href="<?php echo url_for('/employee/logout.php'); ?>">Logout</a></li>
								</ul>

							</navigation>
                        </div>
    			     </div>
    			</div>
    		</article>
    		
    	</header>
		<div class="emloyeeHead">
			<h4>E-Handyman Solutions - Admin Area</h4>
		</div>