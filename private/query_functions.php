<?php

	function find_all_subjects(){
		global $db;
		$sql = "SELECT * FROM subjects ";
  		$sql .= "ORDER BY position ASC";
  		$result = mysqli_query($db, $sql);
  		confirm_result_set($result);
  		return $result;
	}

	function find_subject_by_id($id){
		global $db;
		$sql = "SELECT * FROM subjects ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "'";
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$subject = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $subject;
	}

  function find_subjects_by_id($id){
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    //$subject = mysqli_fetch_assoc($result);
    //mysqli_free_result($result);
    return $result;
  }

	function insert_subject($subject){
		global $db;

		$errors = validate_subject($subject);

		if(empty(!$errors)){
			return $errors;
		}

		$sql = "INSERT INTO subjects ";
		$sql .= "(menu_name, position, visible, content) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $subject['menu_name']) . "',";
		$sql .= "'" . db_escape($db, $subject['position']) . "',";
    $sql .= "'" . db_escape($db, $subject['visible']) . "',";
		$sql .= "'" . db_escape($db, $subject['content']) . "'";
		$sql .= ")";

		$result = mysqli_query($db, $sql);

		if($result){
			return true;
		}
		else{
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

	function update_subject($subject){
		global $db;

		$errors = validate_subject($subject);

		if(empty(!$errors)){
			return $errors;
		}

		$sql = "UPDATE subjects SET ";
  		$sql .= "menu_name='" . db_escape($db, $subject['menu_name']) . "',";
  		$sql .= "position='" . db_escape($db, $subject['position']) . "',";
      $sql .= "visible='" . db_escape($db, $subject['visible']) . "',";
  		$sql .= "content='" . db_escape($db, $subject['content']) . "' ";
  		$sql .= "WHERE id='" . db_escape($db, $subject['id']) . "' ";
  		$sql .= "LIMIT 1";

  		$result = mysqli_query($db, $sql);

  		if($result){
    		return true;
  		}
  		else{
      		echo mysqli_error($db);
      		db_disconnect($db);
      		exit;
  		}
	}

	function delete_subject($id){
		global $db;
		$sql = "DELETE FROM subjects ";
    	$sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    	$sql .= "LIMIT 1";
    	$result = mysqli_query($db, $sql);

    	if($result){
        	return true;
    	}
    	else{
        	echo mysqli_error($db);
          	db_disconnect($db);
          	exit;
    	}
	}

	function find_all_pages(){
		global $db;
		$sql = "SELECT * FROM pages ";
  		$sql .= "ORDER BY subject_id ASC, position ASC";
  		$result = mysqli_query($db, $sql);
  		confirm_result_set($result);
  		return $result;
	}

	function find_page_by_id($id){
		global $db;
		$sql = "SELECT * FROM pages ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "'";
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$page = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $page;
	}

	function insert_page($page){
		global $db;

		$errors = validate_page($page);
		if(!empty($errors)){
			return $errors;
		}

		$sql = "INSERT INTO pages ";
		$sql .= "(subject_id, menu_name, position, visible, content) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $page['subject_id']) . "',";
		$sql .= "'" . db_escape($db, $page['menu_name']) . "',";
		$sql .= "'" . db_escape($db, $page['position']) . "',";
		$sql .= "'" . db_escape($db, $page['visible']) . "',";
		$sql .= "'" . db_escape($db, $page['content']) . "'";
		$sql .= ")";

		$result = mysqli_query($db, $sql);

		if($result){
			return true;
		}
		else{
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

	function update_page($page){
		global $db;

		$errors = validate_page($page);
		if(!empty($errors)){
			return $errors;
		}
		
		$sql = "UPDATE pages SET ";
		$sql .= "subject_id='" . db_escape($db, $page['subject_id']) . "',";
  		$sql .= "menu_name='" . db_escape($db, $page['menu_name']) . "',";
  		$sql .= "position='" . db_escape($db, $page['position']) . "',";
  		$sql .= "visible='" . db_escape($db, $page['visible']) . "',";
  		$sql .= "content='" . db_escape($db, $page['content']) . "' ";
  		$sql .= "WHERE id='" . db_escape($db, $page['id']) . "' ";
  		$sql .= "LIMIT 1";

  		$result = mysqli_query($db, $sql);

  		if($result){
    		return true;
  		}
  		else{
      		echo mysqli_error($db);
      		db_disconnect($db);
      		exit;
  		}
	}

	function delete_page($id){
		global $db;
		$sql = "DELETE FROM pages ";
    	$sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    	$sql .= "LIMIT 1";
    	$result = mysqli_query($db, $sql);

    	if($result){
        	return true;
    	}
    	else{
        	echo mysqli_error($db);
          	db_disconnect($db);
          	exit;
    	}
	}

	function validate_subject($subject) {

  		$errors = [];
  
  		// menu_name
  		if(is_blank($subject['menu_name'])) {
    		$errors[] = "Name cannot be blank.";
  		}
	  	else if(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
    		$errors[] = "Name must be between 2 and 255 characters.";
  		}

  		// position
  		// Make sure we are working with an integer
  		$postion_int = (int) $subject['position'];
  		if($postion_int <= 0) {
    		$errors[] = "Position must be greater than zero.";
  		}
  		if($postion_int > 999) {
    		$errors[] = "Position must be less than 999.";
  		}

  		// visible
  		// Make sure we are working with a string
  		$visible_str = (string) $subject['visible'];
  		if(!has_inclusion_of($visible_str, ["0","1"])) {
    		$errors[] = "Visible must be true or false.";
  		}

      // content
    if(is_blank($subject['content'])) {
      $errors[] = "Content cannot be blank.";
    }

  		return $errors;
	}

	function validate_page($page) {
    $errors = [];

    // subject_id
    if(is_blank($page['subject_id'])) {
      $errors[] = "Subject cannot be blank.";
    }

    // menu_name
    if(is_blank($page['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    $current_id = $page['id'] ?? '0';
    if(!has_unique_page_menu_name($page['menu_name'], $current_id)){
        $errors[] = "Menu name must be unique.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $page['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    // content
    if(is_blank($page['content'])) {
      $errors[] = "Content cannot be blank.";
    }

    return $errors;
  }

  function find_pages_by_subject_id($subject_id){
    global $db;
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }  
// Users

  // Find all users, ordered last_name, first_name
  function find_all_users() {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_user_by_id($id) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function find_user_by_username($username) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function validate_user($user, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($user['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($user['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($user['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($user['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($user['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($user['username'], $user['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if($password_required){
      if(is_blank($user['password'])) {
      $errors[] = "Password cannot be blank.";
    } elseif (!has_length($user['password'], array('min' => 12))) {
      $errors[] = "Password must contain 12 or more characters";
    } elseif (!preg_match('/[A-Z]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 uppercase letter";
    } elseif (!preg_match('/[a-z]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 lowercase letter";
    } elseif (!preg_match('/[0-9]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 number";
    } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 symbol";
    }

    if(is_blank($user['confirm_password'])) {
      $errors[] = "Confirm password cannot be blank.";
    } elseif ($user['password'] !== $user['confirm_password']) {
      $errors[] = "Password and confirm password must match.";
    }
      
    }
    

    return $errors;
  }

  function insert_user($user) {
    global $db;

    // $errors = validate_user($user);
    // if (!empty($errors)) {
    //   return $errors;
    // }

    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users ";
    $sql .= "(user_type, username, hashed_password, first_name, last_name, email, mobile, address) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $user['user_type']) . "',";
    $sql .= "'" . db_escape($db, $user['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "',";
    $sql .= "'" . db_escape($db, $user['first_name']) . "',";
    $sql .= "'" . db_escape($db, $user['last_name']) . "',";
    $sql .= "'" . db_escape($db, $user['email']) . "',";
    $sql .= "'" . db_escape($db, $user['mobile']) . "',";
    $sql .= "'" . db_escape($db, $user['address']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_user($user) {
    global $db;

    $password_sent = !is_blank($user['password']);

    // $errors = validate_user($user, ['password_required' => $password_sent]);
    // if (!empty($errors)) {
    //   return $errors;
    // }

    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE users SET ";
    $sql .= "user_type='" . db_escape($db, $user['user_type']). "',";
     $sql .= "username='" . db_escape($db, $user['username']) . "',";
     if($password_sent){
        $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "',";
    }
    $sql .= "first_name='" . db_escape($db, $user['first_name']) . "',";
    $sql .= "last_name='" . db_escape($db, $user['last_name']) . "',";
    $sql .= "email='" . db_escape($db, $user['email']) . "',";
    $sql .= "mobile='" . db_escape($db, $user['mobile']) . "',";
    $sql .= "address='" . db_escape($db, $user['address']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_user($user) {
    global $db;

    $sql = "DELETE FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  //Dealers

  function find_all_dealers() {
    global $db;

    $sql = "SELECT * FROM dealers ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_dealer_by_id($id) {
    global $db;

    $sql = "SELECT * FROM dealers ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $dealer = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $dealer; // returns an assoc. array
  }

  function insert_dealer($dealer) {
    global $db;

    // $errors = validate_user($user);
    // if (!empty($errors)) {
    //   return $errors;
    // }

    $hashed_password = password_hash($dealer['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO dealers ";
    $sql .= "(user_type, username, hashed_password, first_name, last_name, email, mobile, service_type, service_sub_type,
              hourlyRate, address, city, available) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $dealer['user_type']) . "',";
    $sql .= "'" . db_escape($db, $dealer['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "',";
    $sql .= "'" . db_escape($db, $dealer['first_name']) . "',";
    $sql .= "'" . db_escape($db, $dealer['last_name']) . "',";
    $sql .= "'" . db_escape($db, $dealer['email']) . "',";
    $sql .= "'" . db_escape($db, $dealer['mobile']) . "',";
    $sql .= "'" . db_escape($db, $dealer['service_type']) . "',";
    $sql .= "'" . db_escape($db, $dealer['service_sub_type']) . "',";
    $sql .= "'" . db_escape($db, $dealer['hourlyRate']) . "',";
    $sql .= "'" . db_escape($db, $dealer['address']) . "',";
    $sql .= "'" . db_escape($db, $dealer['city']) . "',";
    $sql .= "'" . db_escape($db, $dealer['available']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_dealer($dealer) {
    global $db;

    $password_sent = !is_blank($dealer['password']);

    // $errors = validate_user($user, ['password_required' => $password_sent]);
    // if (!empty($errors)) {
    //   return $errors;
    // }

    $hashed_password = password_hash($dealer['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE dealers SET ";
    $sql .= "user_type='" . db_escape($db, $dealer['user_type']) . "',";
     $sql .= "username='" . db_escape($db, $dealer['username']) . "',";
     if($password_sent){
        $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "',";
    }
    $sql .= "first_name='" . db_escape($db, $dealer['first_name']) . "',";
    $sql .= "last_name='" . db_escape($db, $dealer['last_name']) . "',";
    $sql .= "email='" . db_escape($db, $dealer['email']) . "',";
    $sql .= "mobile='" . db_escape($db, $dealer['mobile']) . "',";
    $sql .= "service_type='" . db_escape($db, $dealer['service_type']) . "',";
    $sql .= "service_sub_type='" . db_escape($db, $dealer['service_sub_type']) . "',";
    $sql .= "hourlyRate='" . db_escape($db, $dealer['hourlyRate']) . "',";
    $sql .= "address='" . db_escape($db, $dealer['address']) . "',";
    $sql .= "city='" . db_escape($db, $dealer['city']) . "',";
    $sql .= "available='" . db_escape($db, $dealer['available']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $dealer['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

      if($result){
        return true;
      }
      else{
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function update_dealer_availability($dealer) {
    global $db;

    $sql = "UPDATE dealers SET ";
    $sql .= "available='" . 0 . "' ";
    $sql .= "WHERE username='" . db_escape($db, $dealer) . "' ";
  //  $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

      if($result){
        return true;
      }
      else{
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function find_dealer_by_username($username) {
    global $db;

    $sql = "SELECT * FROM dealers ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $dealer = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $dealer; // returns an assoc. array
  }

  function find_dealers_by_service_sub_type($service_sub_type) {
    global $db;

    $sql = "SELECT * FROM dealers ";
    $sql .= "WHERE service_sub_type='" . db_escape($db, $service_sub_type) . "' ";
    $sql .= "and available='" . 1 . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    //$dealer = mysqli_fetch_assoc($result); // find first
    //mysqli_free_result($result);
    return $result; // returns an assoc. array
  }

  function delete_dealer($dealer) {
    global $db;

    $sql = "DELETE FROM dealers ";
    $sql .= "WHERE id='" . db_escape($db, $dealer['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }


  //Admins
  function find_all_admins() {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function insert_admin($admin) {
    global $db;

    // $errors = validate_user($user);
    // if (!empty($errors)) {
    //   return $errors;
    // }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins ";
    $sql .= "(user_type, username, hashed_password, first_name, last_name, email) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['user_type']) . "',";
    $sql .= "'" . db_escape($db, $admin['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "',";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['email']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_admin($admin) {
    global $db;

    $password_sent = !is_blank($admin['password']);

    // $errors = validate_admin($admin, ['password_required' => $password_sent]);
    // if (!empty($errors)) {
    //   return $errors;
    // }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE admins SET ";
    $sql .= "user_type='" . db_escape($db, $admin['user_type']) . "',";
    $sql .= "username='" . db_escape($db, $admin['username']) . "',";
    if($password_sent){
        $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "',";
    }
    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "email='" . db_escape($db, $admin['email']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function delete_admin($admin) {
    global $db;

    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }





  //insert requested service

  function insert_requestedService($requested_service){
    global $db;

    $sql = "INSERT INTO requestedservices ";
    $sql .= "(username, first_name, last_name, service_sub_type, booking_date, email, mobile, address, instructions) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $requested_service['username']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['first_name']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['last_name']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['service_sub_type']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['booking_date']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['email']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['mobile']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['address']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['instructions']) . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);

    if($result){
      return true;
    }
    else{
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function find_requested_service_by_id($id){
    global $db;
    $sql = "SELECT * FROM requestedservices ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $requested_services = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $requested_services;
  }

  function find_requestedService_by_username($username) {
    global $db;

    $sql = "SELECT * FROM requestedservices ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    //$requestedService = mysqli_fetch_assoc($result); // find first
    //mysqli_free_result($result);
    return $result; // returns an assoc. array
  }


  function find_all_requested_services(){
    global $db;
    $sql = "SELECT * FROM requestedservices ";
      $sql .= "ORDER BY id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function delete_requested_service($id){
    global $db;
    $sql = "DELETE FROM requestedservices ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);

      if($result){
          return true;
      }
      else{
          echo mysqli_error($db);
            db_disconnect($db);
            exit;
      }
  }

  function find_requested_service_by_service_type($service_sub_type) {
    global $db;

    $sql = "SELECT * FROM requestedservices ";
    $sql .= "WHERE service_sub_type='" . db_escape($db, $service_sub_type) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $service = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $service; // returns an assoc. array
  }


  function insert_assignedService($requested_service){
    global $db;

    $sql = "INSERT INTO assignservices ";
    $sql .= "(dealer_name, service_sub_type, username, booking_date, service_assigning_date, mobile, address, instructions, isAssigned, serviceStatus, service_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $requested_service['dealer_name']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['service_sub_type']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['username']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['booking_date']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['service_assigning_date']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['mobile']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['address']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['instructions']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['isAssigned']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['serviceStatus']) . "',";
    $sql .= "'" . db_escape($db, $requested_service['service_id']) . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);

    if($result){
      return true;
    }
    else{
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function find_selected_assigned_services($id){
    global $db;
    $sql = "SELECT isAssigned FROM assignservices ";
      $sql .= "WHERE service_id='" . db_escape($db, $id) . "' ";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $service = mysqli_fetch_row($result); // find first
      //var_dump($service);
      if(!is_null($service)){
      foreach ($service as $value) {
          if($value== 1){
          return true;
      }
      }}
    
    return false; // returns an assoc. array
  }



  function find_all_assigned_services(){
    global $db;
    $sql = "SELECT * FROM assignservices ";
      $sql .= "ORDER BY id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }


  function find_assigned_service_by_dealerName($dealer_name) {
    global $db;

    $sql = "SELECT * FROM assignservices ";
    $sql .= "WHERE dealer_name='" . db_escape($db, $dealer_name) . "' ";
    $sql .= "and serviceStatus!='Complete' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $dealer = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $dealer; // returns an assoc. array
  }

  function find_assigned_service_by_id($id){
    global $db;
    $sql = "SELECT * FROM assignservices ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $assigned_service = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $assigned_service;
  }

  function delete_assigned_service($id){
    global $db;
    $sql = "DELETE FROM assignservices ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);

      if($result){
          return true;
      }
      else{
          echo mysqli_error($db);
            db_disconnect($db);
            exit;
      }
  }


  function find_all_contact_us_requests() {
    global $db;

    $sql = "SELECT * FROM contact_us ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function insert_contact_us($contact) {
    global $db;


    $sql = "INSERT INTO contact_us ";
    $sql .= "(customerName, customerEmail, customerContact, customerSubject, customerMessage) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $contact['customerName']) . "',";
    $sql .= "'" . db_escape($db, $contact['customerEmail']) . "',";
    $sql .= "'" . db_escape($db, $contact['customerContact']) . "',";
    $sql .= "'" . db_escape($db, $contact['customerSubject']) . "',";
    $sql .= "'" . db_escape($db, $contact['customerMessage']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function find_all_updated_services() {
    global $db;

    $sql = "SELECT * FROM update_service_details_dealer ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_updated_service_by_id($id){
    global $db;
    $sql = "SELECT * FROM update_service_details_dealer ";
    $sql .= "WHERE service_id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $updatedService = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $updatedService;
  }


  function insert_updated_service($updated_service){
    global $db;

    $sql = "INSERT INTO update_service_details_dealer ";
    $sql .= "(user_first_name, user_last_name, dealer_name, service_sub_type, service_assigning_date, serviceStatus, jobDescription, numHoursWorked, hourlyRate, accessoriesCharges, totalPayment, paymentReceived, service_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $updated_service['user_first_name']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['user_last_name']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['dealer_name']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['service_sub_type']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['service_assigning_date']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['serviceStatus']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['jobDescription']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['numHoursWorked']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['hourlyRate']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['accessoriesCharges']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['totalPayment']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['paymentReceived']) . "',";
    $sql .= "'" . db_escape($db, $updated_service['service_id']) . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);

    if($result){
      return true;
    }
    else{
      echo mysqli_error($db);

      db_disconnect($db);
      exit;
    }
  }

  // function find_updated_assigned_services($id){
  //   global $db;
  //   $sql = "SELECT serviceStatus FROM assignservices ";
  //     $sql .= "WHERE service_id='" . db_escape($db, $id) . "' ";
  //     $result = mysqli_query($db, $sql);
  //     confirm_result_set($result);
  //     $service = mysqli_fetch_row($result); // find first
  //     //var_dump($service);
  //     if(!is_null($service)){
  //     foreach ($service as $value) {
  //         return $value;
  //     }
  //     }
    
  //   return false; // returns an assoc. array
  // }

  function update_sercvice_status($serviceStatus,$service_id) {
    global $db;

    $sql = "UPDATE assignservices SET ";
    $sql .= "serviceStatus='" . db_escape($db, $serviceStatus) . "' ";
    $sql .= "WHERE service_id='" . db_escape($db, $service_id) . "' ";
  //  $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

      if($result){
        return true;
      }
      else{
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }


?>