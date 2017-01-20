<?php
  require_once('../private/initialize.php');
  require_once('../private/functions.php');
  require_once('../private/db_credentials.php');

  // Initialize variables
  $first_name = '';
  $last_name = '';
  $email = '';
  $username = '';

  if(is_post_request()) {
    // Check to make sure post value is there before setting
    $first_name = isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';

    // Perform Validations
    $errors = check_errors($first_name, $last_name, $email, $username);
    $num_errors = count($errors);

    // If there were no errors, insert into sql database and redirect
    if($num_errors == 0) {
      // Connect to database
      $db = db_connect();
      $sql_select = "SELECT username FROM users";
      $result_select = db_query($db, $sql_select);
      $match = False;

      // Check for uniqueness
      while($name = $result_select->fetch_assoc()) {
        $name = $name["username"];
        if($name == $username) {
          $match = True;
        }
      }

      if(!$match) {
        $sql = "";
        $sql .= "INSERT INTO users (first_name, last_name, email, username, created_at) VALUES ('" 
         . $first_name . "', '"
         . $last_name . "', '"
         . $email . "', '"
         . $username . "', '"
         . date("Y-m-d H:i:s") . "');";

        $result = db_query($db, $sql);
        if($result) {
          db_close($db);
          header('Location: ./registration_success.php');
        } else {
          // The SQL INSERT statement failed.
          // Just show the error, not the form
          echo db_error($db);
          db_close($db);
          exit;
        }
      } else {
        array_push($errors, "Username is taken.");
      }
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
    First Name:<br />
    <input type="text" name="first_name" value="<?php echo $first_name ?>"/><br />
    Last Name:<br />
    <input type="text" name="last_name" value="<?php echo $last_name ?>" /><br />
    Email:<br />
    <input type="text" name="email" value="<?php echo $email ?>" /><br />
    Username:<br />
    <input type="text" name="username" value="<?php echo $username ?>" /><br /><br />
    <input type="submit" name="submit" value="Submit" />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
</body>
</html>
