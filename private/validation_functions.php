<?php

  // is_blank('abcd')
  function is_blank($value='') {
    if(strlen($value) == 0) {
      return True
    }
    return False
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value)
    if($length >= $options['min'] && $length <= $options['max']) {
      return True
    }
    return False
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    $returnval = strrpos($value, "@")
    if($returnval === False) {
      return False
    }
    return True
  }

?>
