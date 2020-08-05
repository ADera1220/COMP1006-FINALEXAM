<?php require_once('header.php'); ?>
<body>
<div class="container">
<?php require_once('navigation.php'); ?>
<main>
    <?php

        //create variables to store form data
        $first_name = trim(filter_input(INPUT_POST, 'first_name'));
        $last_name = trim(filter_input(INPUT_POST, 'last_name'));
        $phone_number = trim(filter_input(INPUT_POST, 'phone_number'));
        $position = trim(filter_input(INPUT_POST, 'position'));

        if(empty($_FILES['profile_img']['name'])){
            $profile_img = 'default-profile-pic.png';
        } else {
            $profile_img = $_FILES['profile_img']['name'];
        }
        $photo_type = $_FILES['profile_img']['type'];
        $photo_size = $_FILES['profile_img']['size'];

        //define image constants
        define('UPLOADPATH', 'img/');
        define('MAXFILESIZE', 32786); //32 KB
        
        

        $user_id = null;
        $user_id = filter_input(INPUT_POST, 'user_id');

        //set up a flag variable\
        $ok = true;

        //validate input
        if(empty($first_name)) {
            echo '<p>Please provide both first and last name</p>';
            echo '<a href="add.php">GO BACK</a>';
            $ok = false;
        }
        //check for input in the password field
        if(empty($last_name)) {
            echo '<p>Please provide a password</p>';
            echo '<a href="add.php">GO BACK</a>';
            $ok = false;
        }
        //location
        if(empty($phone_number)) {
            echo '<p>Please tell us your phone number</p>';
            echo '<a href="add.php">GO BACK</a>';
            $ok = false;
        }
        //email (check format)
        if(empty($position)) {
            echo '<p>Please enter your team position</p>';
            echo '<a href="add.php">GO BACK</a>';
            $ok = false;
        }
        // check photo is the right size and type 
        if ((($photo_type !== 'image/gif') || 
            ($photo_type !== 'image/jpeg') || 
            ($photo_type !== 'image/jpg') || 
            ($photo_type !== 'image/png')) && 
            ($photo_size < 0) && 
            ($photo_size >= MAXFILESIZE)) {
            //making sure no upload errors 
            if ($_FILES['profile_img']['error'] !== 0) {
                $ok = false;
                echo "Please submit a photo that is a jpg, png or gif and less than 32kb";
            }

        }

        if ($ok === true) {
            try {

                //open a connection
                require_once('connect.php');

                //finishes moving the photo to the final directory from the temp
                $target = UPLOADPATH.$profile_img;
                move_uploaded_file($_FILES['profile_img']['tmp_name'], $target);
                
                //if the id variable is not empty, we update the information
                if(!empty($user_id)) {
                    //create an SQL query for the info UPDATE
                    $sql = "UPDATE players SET first_name = :first_name, last_name = :last_name, profile_img = :profile_img, phone_number = :phone_number, position = :position WHERE user_id = :user_id;";
                }
                else {
                    //set up SQL command to insert data into table
                    $sql = "INSERT INTO players(first_name, last_name, profile_img, phone_number, position) VALUES (:first_name, :last_name, :profile_img, :phone_number, :position);";
                }

                //call the prepare method with the SQL query as a parameter, this returns the PDOStatement object
                $stmnt = $db->prepare($sql);

                //bind the parameters
                $stmnt->bindParam(':first_name', $first_name);
                $stmnt->bindParam(':last_name', $last_name);
                $stmnt->bindParam(':profile_img', $profile_img);
                $stmnt->bindParam(':phone_number', $phone_number);
                $stmnt->bindParam(':position', $position);

                //if statement for updates, if the user_id is there, it treats it as an UPDATE
                if(!empty($user_id)) {
                    $stmnt->bindParam(':user_id', $user_id);
                }

                //execute the statement, then close the connection
                $stmnt->execute();
                echo "<h1> Thanks for sharing! </h1>";
                $stmnt->closeCursor();
            }
            catch(PDOException $e) {
                $err_msg = $e->getMessage();
                echo "<h1>Sorry, but there was an error: $err_msg</h1>";
            }
        }
    ?>
    <a href="add.php" class="error-btn"> Back to Form </a>
</main>
<?php require_once('footer.php') ?>