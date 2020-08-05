<?php 
require_once('header.php');
require_once('navigation.php');
//grab the information the user entered in the form
$user = trim(filter_input(INPUT_POST, 'username'));
$pw = trim(filter_input(INPUT_POST, 'password'));
$confirm = trim(filter_input(INPUT_POST, 'confirm'));

//set a flag variable
$ok = true;
if(empty($user)) {
    $ok = false;
    echo "<p> Please enter a username! </p>";
}

if(empty($pw)) {
    $ok = false;
    echo "<p> Please enter a password! </p>";
}

if($pw != $confirm) {
    $ok = false;
    echo "<p> Passwords don't match! </p>";
}

try {
    if($ok === true) {
        //connect
        require_once('connect.php');

        //set up query
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        
        //prepare, bind and execute the query
        $statement = $db->prepare($sql);
        $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);
        $statement->bindParam(':username', $user);
        $statement->bindParam(':password', $hashed_pw);
        $statement->execute();

        //close connection
        $statement->closeCursor();
        echo "<p> Thank you for registering! <a href='login.php'>Click here to log in</a></p>";

    }
}
catch (PDOException $e) {
    $e_msg = $e->getMessage();
    echo $e_msg;
}


require_once('footer.php');
?>