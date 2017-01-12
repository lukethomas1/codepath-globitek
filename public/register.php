<?php
  require_once('../private/initialize.php');
  require_once('../private/functions.php');
  require_once('../private/db_credentials.php');

  $db = db_connect();

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
    $errors = check_errors($first_name, $last_name, $email, $username);

    $num_errors = count($errors);

    if($num_errors == 0) {   
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

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php display_errors($errors); ?>

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
</body>
</html>
