<?php

  // is_blank('abcd')
  function is_blank($value='') {
    if(strlen($value) == 0) {
      return True;
    }
    return False;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if($length >= $options['min'] && $length <= $options['max']) {
      return True;
    }
    return False;
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    $returnval = strrpos($value, "@");
    if($returnval === False) {
      return False;
    }
    return True;
  }

  function check_errors($first_name, $last_name, $email, $username) {
    $errors = [];

    # First name
    if(is_blank($first_name)) {
      array_push($errors, blank_error("First name"));
    }
    elseif(!has_length($first_name, ['min' => 2, 'max' => 255])) {
      array_push($errors, length_error("First name", 2, 255));
    }

    # Last name
    if(is_blank($last_name)) {
      array_push($errors, blank_error("Last name"));
    }
    elseif(!has_length($last_name, ['min' => 2, 'max' => 255])) {
      array_push($errors, length_error("Last name", 2, 255));
    }

    # Email
    if(is_blank($email)) {
      array_push($errors, blank_error("Email"));
    }
    elseif(!has_valid_email_format($email)) {
      array_push($errors, format_error("Email"));
    }

    # Username
    if(is_blank($username)) {
      array_push($errors, blank_error("Username"));
    }
    elseif(!has_length($username, ['min' => 8, 'max' => 255])) {
      array_push($errors, length_error("Username", 8));
    }

    return $errors;
  }
?>
