<?php
session_start();
?>
<?php
/**
 * change-account.php, this script allows the user to change their username and email address.
 * Created by Callum-James Smith (cs18804)
 */
require_once 'db.php';
if (isset($_GET['new-name'])) 
// Change users username
{

    $newName = $_GET['new-name'];

    if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) // Checks to see if the username is valid (contains letters A-Z and integers 0-9)
        {
            header("Location: account.php?error=invalidname");
            // ^ throws an error and takes the user back to the account page
            exit();
        }

    mysqli_query($connection, "UPDATE users SET name='" . $newName . "' WHERE id=" . $_SESSION['id'] . "");
    $_SESSION['name'] =  $newName; // I changed the session variable value so the user hello section will work
    header("Location: account.php");
    exit();
} 
else if (isset($_GET['new-email'])) 
// Change users email address
{

    $newEmail = $_GET['new-email'];
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        header("Location: account.php?error=invalidemail");
        // ^ throws an error and returns the user back to the account page
        exit();
    }

    require 'functions.inc.php';
    send_mail($newEmail, $_SESSION['name']);


    // mysqli_query($connection, "UPDATE users SET email='" . $newEmail . "' WHERE id=" . $_SESSION['id'] . "");
    header("Location: account.php?verify=newemail");
    exit();
}

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    require 'db.php';
    // Verify data
    $email = $_GET['email']; // Set email variable
    $hash = $_GET['hash']; // Set hash variable

    $search = mysqli_query($connection,"SELECT email, hash, verfied FROM users WHERE email='".$email."' AND hash='".$hash."' AND verfied='0'") or die(mysqli_error($connection));
    $match  = mysqli_num_rows($search);

    if ($match) {
        mysqli_query($connection, "UPDATE users SET email='" . $newEmail . "' WHERE id=" . $_SESSION['id'] . "") or die(mysqli_error($connection));
        header("Location: account.php?email_verified");
        exit();
    }

}
