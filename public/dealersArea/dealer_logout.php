<?php
require_once('../../private/initialize.php');

log_out_dealer();
// or you could use
// $_SESSION['username'] = NULL;

//redirect_to(url_for('/employee/login.php'));
redirect_to(url_for('/index.php?subject_id=6'));


?>
