<?php

  // Performs all actions necessary to log in an user
  function log_in_user($user) {
  // Renerating the ID protects the user from session fixation.
    session_regenerate_id();

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_type'] = $user['user_type'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['mobile'] = $user['mobile'];
    $_SESSION['address'] = $user['address'];

    return true;
  }

  function log_out_user(){
    unset($_SESSION['user_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    unset($_SESSION['user_type']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    unset($_SESSION['email']);
    unset($_SESSION['mobile']);
    unset($_SESSION['address']);

    return true;
  }

  //try changing session username for admin and dealer

  function log_in_dealer($dealer) {
  // Renerating the ID protects the user from session fixation.
    session_regenerate_id();
    $_SESSION['dealer_id'] = $dealer['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['dealer_name'] = $dealer['username'];
    $_SESSION['user_type'] = $dealer['user_type'];
    return true;
  }

  function log_out_dealer(){
    unset($_SESSION['dealer_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['dealer_name']);
    unset($_SESSION['user_type']);

    return true;
  }

  function log_in_admin($admin) {
  // Renerating the ID protects the user from session fixation.
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['admin_name'] = $admin['username'];
    $_SESSION['user_type'] = $admin['user_type'];
    //phpAlert("Admin Logged In");
    return true;
  }
  function log_out_admin(){
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['admin_name']);
    unset($_SESSION['user_type']);

    return true;
  }

  function is_logged_in(){
    if(isAdmin()){
      return isset($_SESSION['admin_id']);
    }
    else if(isUser()){
      return isset($_SESSION['user_id']);
    }
    else if(isDealer()){
      return isset($_SESSION['dealer_id']);
    }
  }

  function require_login(){
    if(!is_logged_in()){
      redirect_to(url_for('index.php?subject_id=6'));
    }
    else if(is_logged_in()){
        if(isAdmin()){
            //redirect_to(url_for('/employee/index.php'));
            $_SESSION['message'] = "Logged in as admin";

        }
        else if(isUser()){
            //redirect_to(url_for('index.php'));
            $_SESSION['message'] = "Logged in as user";
        }
        else if(isDealer()){
            $_SESSION['message'] = "Logged in as dealer";
            //redirect_to(url_for('/dealersArea/index.php'));

        }
        else{
          
        }
    }
  }

  function isAdmin()
    {
      if ($_SESSION['user_type'] == 'admin') {
        return true;
      }else{
        return false;
      }
    }

    function isUser()
    {
      if ($_SESSION['user_type'] == 'user') {
        return true;
      }else{
        return false;
      }
    }

    function isDealer()
    {
      if ($_SESSION['user_type'] == 'dealer') {
        return true;
      }else{
        return false;
      }
    }

?>
