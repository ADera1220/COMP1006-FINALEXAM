<?php
try{
    require_once('connect.php');

    //define a flag variable
    $ok = true;

    //grab the information from the form, and also validate
    if(empty(trim($_POST['username']))) {
        echo "<p>Please provide a username</p>";
        $ok = false;
    } else {
        $uname = trim($_POST['username']);
    }

    if(empty(trim($_POST['password']))) {
        echo "<p>Please provide a password</p>";
        $ok = false;
    } else {
        $pword = trim($_POST['password']);
    }

    //Validate the credentials provided
    if($ok === true) {
        //set up a query to see if the username matched
        $sql = "SELECT * FROM users WHERE username = :username;";

        //prepare, bind, and execute
        $statement = $db->prepare($sql);
        $statement->bindParam(':username', $uname);
        $statement->execute();

        if($statement->rowCount() == 1) {
            if($row = $statement->fetch()) {
                $id = $row['user_id'];
                $user_name = $row['username'];
                $hash_pw = $row['password'];

                if(password_verify($pword, $hash_pw)) {
                    //password matches
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $user_name;

                    //direct user to restricted page
                    header('location:view.php');
                }
            }
        }
        else {
            echo "<p>Sorry, something went wrong.</p>";
        }

        $statement->closeCursor();
    }
}
catch(PDOException $e) {
    $e_msg = $e->getMessage();
    echo $e_msg;
}
?>