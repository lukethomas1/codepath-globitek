<?php

  function h($string="") {
    return htmlspecialchars($string);
  }

  function u($string="") {
    return urlencode($string);
  }

  function raw_u($string="") {
    return rawurlencode($string);
  }

  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }

  function is_post_request() {
    return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] == 'POST' : False;
  }

  function display_errors($errors) {
    $output = '';
    if (!empty($errors)) {
      $output .= "<div class=\"errors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach ($errors as $error) {
        $output .= "<li>{$error}</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }

  function blank_error($where) {
    return $where . " cannot be blank.";
  }

  function length_error($where, $min, $max=0) {
    if($max == 0) {
      return $where . " must be at least " . $min . " characters.";
    }
    return $where . " must be between " . $min . " and " . $max . " characters.";
  }

  function format_error($where) {
    return $where . " must be a valid format.";
  }

?>
