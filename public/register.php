<?php
  require_once('../private/initialize.php');
  require_once('../private/functions.php');
  require_once('../private/db_credentials.php');

  $db = db_connect();

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help
  $first_name = '';
  $last_name = '';
  $email = '';
  $username = '';
  $password = '';
  if(is_post_request()) {

    // Confirm that POST values are present before accessing them.
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

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

      // Redirect ot succes page
      header('Location: ./registration_success.php');
    }
  }

?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    if(is_post_request()) {
      echo display_errors($errors);
    }
  ?>

  <!-- TODO: HTML form goes here -->
  <form action="register.php" method="post">
    First Name:
    <input type="text" name="first_name" value="<?php echo $first_name ?>"/>
    Last Name:
    <input type="text" name="last_name" value="<?php echo $last_name ?>" /><br />
    Email:
    <input type="text" name="email" value="<?php echo $email ?>" /><br />
    Username:
    <input type="text" name="username" value="<?php echo $username ?>" /><br />
    Password:
    <input type="password" name="password" value="<?php echo $password ?>" /><br />
    <input type="submit" name="submit" value="Submit" />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
</body>
</html>
