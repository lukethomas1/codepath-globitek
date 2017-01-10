<?php
  require_once('../private/initialize.php');
  require_once('../private/functions.php');

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help
  if(is_post_request()) {

    // Confirm that POST values are present before accessing them.
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $submit = isset($_POST['submit']) ? $_POST['submit'] : '';

    // Perform Validations
    // Hint: Write these in private/validation_functions.php
    $errors = []

    # First name
    if(is_blank($first_name)) {
      array_push($errors, blank_error("First name"))
    }
    elseif(!has_length($first_name, ['min' => 2, 'max' => 255])) {
      array_push($errors, length_error("First name", 2, 255))
    }

    # Last name
    if(is_blank($last_name)) {
      array_push($errors, blank_error("Last name"))
    }
    elseif(!has_length($last_name, ['min' => 2, 'max' => 255])) {
      array_push($errors, length_error("Last name", 2, 255))
    }

    # Email
    if(is_blank($email)) {
      array_push($errors, blank_error("Email"))
    }
    elseif(!has_valid_email_format($email)) {
      array_push($errors, format_error("Email"))
    }

    # Username
    if(is_blank($username)) {
      array_push($errors, blank_error("Username"))
    }
    elseif(!has_length($username, ['min' => 8, 'max' => 255])) {
      array_push($errors, length_error("Username", 8))
    }

    $num_errors = count($errors)

    if($num_errors > 0) {
      display_errors($errors)
    }
    // if there were no errors, submit data to database
    else {      
      // Write SQL INSERT statement
      // $sql = "";

      // For INSERT statments, $result is just true/false
      // $result = db_query($db, $sql);
      // if($result) {
      //   db_close($db);

      //   TODO redirect user to success page

      // } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
      //   echo db_error($db);
      //   db_close($db);
      //   exit;
      // }
    }
  }

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
  ?>

  <!-- TODO: HTML form goes here -->
  <form action="register.php" method="post">
    <input type="text" name="first_name" value="" />
    <input type="text" name="last_name" value="" /><br />
    <input type="text" name="email" value="" /><br />
    <input type="text" name="username" value="" /><br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" value="Submit" />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
