<?php 

include('db.php');
$LoggedIn = false;
if (isset($_POST['action'])) {

    if ($_POST['action'] == 'login') {
        // If the user selects login...
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $selectQuery = mysqli_query($connection, "SELECT name FROM users WHERE email='".$email."' AND password='".md5($password)."'");
        $Result = mysqli_fetch_array($selectQuery); // Store info in new variable 
        if ($Result >= 1) // If the user logs in successfully
        {
            $_SESSION = true; // Create a session for the user
            $LoggedIn = true;
            header("Location: landing.php"); // Navigate to landing page
            
        } elseif ($Result != 1) {
            $message = "Incorrect Email or Password!";
            $_SESSION['loggedIn'] = false;
        }
    }
    elseif ($_POST['action'] == 'signup') {
        // If the user selects Sign Up...

        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $query = "SELECT email FROM users WHERE email='".$email."'";
        $result = mysqli_query($connection, $query); // Stores the result
        $Rnumber = mysqli_num_rows($result); // Stores the amount of rows from the query

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Checks to see if the Email address in a valid format
        {
            $message = "Invalid Email address!";
        }
        elseif ($Rnumber >= 1) // If a row already exists (if a user exists)
        {
            $message = "A user with these details already exists!";
        }
        else {
            // Insert the users data in the table
            mysqli_query($connection,"INSERT INTO users(name,email,password) VALUES('".$name."','".$email."','".md5($password)."')");
            $message = "Sign Up Complete!";
            header("Location: landing.php");
        }
    }
}
mysqli_close($connection);

?>