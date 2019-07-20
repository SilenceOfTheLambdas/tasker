<?php 
/**
 * signupPHP.php
 * This script controls the user signup process
 * Created by: Callum-James Smith (cs18804)
 */
if (isset($_POST['signup-submit'])) // Checks to see if user clicked "signup"
    {
        require 'db.php'; // include the Database connection handler file

        $name = $_POST['name']; // The name given by the user
        $email = $_POST['email']; // The email address given by the user
        $password = $_POST['password']; // The password given by the user
        $passwordRepeat = $_POST['password-repeat']; // The repeated version of the initial password, given by user
        $HashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashes the password using BCRYPT

        $sql = "SELECT email FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: signup.php?sqlerror");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $emailRes = $stmt->get_result();
        $EmailRowNumber = $emailRes->num_rows;

        $sql = "SELECT name FROM users WHERE name=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: signup.php?sqlerror");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $nameRes = $stmt->get_result();
        $NameRowNumber = $nameRes->num_rows;

        if (empty($name) || empty($email) || empty($password) || empty($passwordRepeat))
            // Checks to see if any of the fields are empty
            {
                header("Location: signup.php?error=emptyfields&name=" . $name . "&email=" . $email);
                // ^ throws an error and re-applies the data back into the fields if available
                exit(); // Stop script from running
            } else if ($EmailRowNumber >= 1 || $NameRowNumber >= 1) // If a row matching the email address is found
            {
                header("Location: signup.php?error=userexists");
                // ^ throws an error and re-applies the data back into the fields if available
                exit(); // Stop script from running
            } else if ($password != $passwordRepeat)  // Checks to see if the password are the same
            {
                header("Location: signup.php?error=passwordmismatch&name=" . $name . "&email=" . $email);
                // ^ throws an error and re-applies the data back into the fields if available
                exit();
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: signup.php?error=invalidemail&name=" . $name);
                // ^ throws an error and re-applies the data back into the fields if available
                exit();
            } else if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) // Checks to see if the username is valid (contains letters A-Z and integers 0-9)
            {
                header("Location: signup.php?error=invalidname&email=" . $email);
                // ^ throws an error and re-applies the data back into the fields if available
                exit();
            } else {

            // Create a new activation hash
            $hash = md5( rand(0,1000));

            $sql = "INSERT INTO users(name,email,password,hash) VALUES(?, ?, ?,?)";
            $stmt = mysqli_stmt_init($connection);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: signup.php?sqlerror");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $HashedPassword, $hash);
            mysqli_stmt_execute($stmt);
            include_once "functions.inc.php";
            $Project = ProjectID();

            // Send the email
            $to      = 'techdragonsoft@gmail.com'; // Send email to our user
            $subject = 'Tasker.io Sign Up'; // Give the email a subject 
            $message = '
            
            Thanks for signing up!
            Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
            
            Thanks for signing up!
            Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
            
            ------------------------
            Username: '.$name.'
            Password: '.$password.'
            ------------------------
            
            Please click this link to activate your account:
            http://localhost/index.php?email='.$email.'&hash='.$hash.'
            
            '; // Our message above including the link
                                
            $headers = 'From:admin@techanddragons.co.uk' . "\r\n"; // Set from headers
            mail($to, $subject, $message, $headers); // Send our email
            header("Location: index.php?signup=success&projects=$Project&verify=verifyemail");
            exit();
        }
    }
else if (isset($_POST['back'])) {
    header("Location: index.php");
    exit();
}

