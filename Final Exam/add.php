<?php 
require('header.php');
require('auth.php'); 
?>
<body>
  <?php

  //initialize variables and assign values
  $user_id = null;
  $first_name = null;
  $last_name = null;
  $phone_number = null;
  $position = null;
  
  //initialize process for photo
  if(!empty($_GET['id']) && (is_numeric($_GET['id']))) {
    
    //grab the id from the URL
    $user_id = filter_input(INPUT_GET, 'id');

    //connect to the database
    require_once('connect.php');

    //set up our query
    $sql = "SELECT * FROM players WHERE user_id = :user_id";

    //prepare, bind parameters and execute the query
    $stmnt = $db->prepare($sql);
    $stmnt->bindParam(':user_id', $user_id);
    $stmnt->execute();

    //use fetch() to store the record
    $record = $stmnt->fetch();

    //assign the record values to the variables
    $first_name = $record['first_name'];
    $last_name = $record['last_name'];
    $phone_number = $record['phone_number'];
    $position = $record['position'];

    //close the connection to the database
    $stmnt->closeCursor();
  }
  ?>
  <main>
  <?php require_once('navigation.php'); ?>
    <h1>Add/Edit a Player Record</h1>
    <form action='process.php' method='post' enctype='multipart/form-data' class='form'>
      <!-- special hidden input for the user_id, for editing -->
      <input type='hidden' name='user_id' value="<?php echo $user_id; ?>">
      <div>
        <label for='first_name'>First Name: </label>
        <input type='text' name='first_name' id='first_name' class='form-control' value="<?php echo $first_name; ?>">
      </div>
      <div>
        <label for='last_name'>Last Name: </label>
        <input type='text' name='last_name' id='last_name' class='form-control' value="<?php echo $last_name; ?>">
      </div>
      <div>
        <label for='phone_number'>Phone Number(numbers only): </label>
        <input type='tel' name='phone_number' id='phone_number' class='form-control' value="<?php echo $phone_number; ?>">
      </div>
      <div>
        <label for='position'>Current Position: </label>
        <input type='text' name='position' id='position' class='form-control' value="<?php echo $position; ?>">
      </div>
      <div>
        <label for='profile_img'>Choose a Profile photo(32kb MAX): </label>
        <input type='file' name='profile_img' id='profile_img' class='form-control'>
      </div>
      <div>
        <input type="submit" name="submit" value="Submit" class="btn btn-dark">
      </div>
    </form>
  </main>
  <?php require('footer.php'); ?>