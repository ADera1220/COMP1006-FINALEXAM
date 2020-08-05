<?php 
require('header.php');
require('auth.php'); 
?>
<h1> The Members of Cricket Social</h1>
<main>
<?php require_once('navigation.php'); ?>
    <?php
        try {
            //connect to db
            require_once('connect.php');

            //set up SQL statement
            $sql = "SELECT * FROM players;";

            //prepare the query
            $statement = $db->prepare($sql);

            //execute
            $statement->execute();

            //fetchAll to store the results
            $records = $statement->fetchAll();

            //echo out the top of the table
            echo "<table class='table'><thead class='table table-dark'><th>Photo</th><th>First Name</th><th>Last Name</th><th>Position</th><th>Phone Number</th><th>Delete</th><th>Edit</th></thead><tbody>";

            foreach($records as $record) {
                echo 
                "<tr><td><img src='img/".$record['profile_img']."' alt='".$record['profile_img'].
                "' height='50px' width='50px'>".
                "</td><td>".$record['first_name'].
                "</td><td>".$record['last_name'].
                "</td><td>".$record['position'].
                "</td><td>".$record['phone_number'].
                "</td><td><a href='delete.php?id=".$record['user_id'].
                "'>Delete</a></td><td><a href='add.php?id=".$record['user_id'].
                "'>Edit</a></td></tr>";
            }

            echo "</tbody></table>";

            $statement->closeCursor();
        }
        catch(PDOException $e){
            $err_msg = $e->getMessage();
            echo "<p>$err_msg</p>";
        }
    ?>
</main>
<?php require_once('footer.php'); ?>