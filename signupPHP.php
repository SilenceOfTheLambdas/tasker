<?php 
if (isset($_POST['signup-submit'])) // Checks to see if user clicked "signup"
{
    require 'db.php'; // include the Database connection handler file

    $name = $_POST['name']; // The name given by the user
    $email = $_POST['email']; // The email address given by the user
    $password = $_POST['password']; // The password given by the user
    $passwordRepeat = $_POST['password-repeat']; // The repeated version of the initial password, given by user
    
    $query = "SELECT email FROM users WHERE email='".$email."'";
    $result = mysqli_query($connection, $query);
    $RowNumber = mysqli_num_rows($result);

    if (empty($name) || empty($email) || empty($password) || empty($passwordRepeat))
    // Checks to see if any of the fields are empty
    {
        header("Location: signup.php?error=emptyfields&name=".$name."&email=".$email);
        // ^ throws an error and re-applies the data back into the fields if available
        exit(); // Stop script from running
    }
        if ($RowNumber >= 1) // If a row matching the email address is found
        {
            header("Location: signup.php?error=emailexists&name=".$name."&email=".$email);
            // ^ throws an error and re-applies the data back into the fields if available
            exit(); // Stop script from running
        }else {
            mysqli_query($connection, "INSERT INTO users(name,email,password) VALUES('".$name."','".$email."','".md5($password)."')");
            header("Location: landing.php");
            exit();
        }
    if ($password != $passwordRepeat)  // Checks to see if the password are the same
    {
        header("Location: signup.php?error=passwordmismatch&name=".$name."&email=".$email);
        // ^ throws an error and re-applies the data back into the fields if available
        exit(); // Stop script from running
    }
}
?>