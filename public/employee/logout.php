<?php
require_once('../../private/initialize.php');

log_out_admin();
// or you could use
// $_SESSION['username'] = NULL;

//redirect_to(url_for('/employee/login.php'));
redirect_to(url_for('/index.php'));


?>
