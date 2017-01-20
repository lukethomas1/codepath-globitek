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
    elseif(!preg_match('/\A[A-Za-z\s\-,\.\']+\Z/', $first_name)) {
      array_push($errors, "First name must consist of letters, spaces, symbols: -,.'");
    }

    # Last name
    if(is_blank($last_name)) {
      array_push($errors, blank_error("Last name"));
    }
    elseif(!has_length($last_name, ['min' => 2, 'max' => 255])) {
      array_push($errors, length_error("Last name", 2, 255));
    }
    elseif(!preg_match('/\A[A-Za-z\s\-,\.\']+\Z/', $last_name)) {
      array_push($errors, "Last name must consist of letters, spaces, symbols: -,.'");
    }

    # Email
    if(is_blank($email)) {
      array_push($errors, blank_error("Email"));
    }
    elseif(!has_valid_email_format($email)) {
      array_push($errors, format_error("Email"));
    }
    elseif(!preg_match('/\A[A-Za-z0-9\._@]+\Z/', $email)) {
      array_push($errors, "Email must consist of letters, numbers, symbols: _@.");
    }

    # Username
    if(is_blank($username)) {
      array_push($errors, blank_error("Username"));
    }
    elseif(!has_length($username, ['min' => 8, 'max' => 255])) {
      array_push($errors, length_error("Username", 8));
    }
    elseif(!preg_match('/\A[A-Za-z0-9_]+\Z/', $username)) {
      array_push($errors, "Username must consist of letters, spaces, symbols: _");
    }

    return $errors;
  }
?>
