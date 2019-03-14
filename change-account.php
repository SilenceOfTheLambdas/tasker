<?php
require_once 'db.php';
session_start();
if (isset($_GET['new-name'])) {

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
} else if (isset($_GET['new-email'])) {

    $newEmail = $_GET['new-email'];

    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        header("Location: account.php?error=invalidemail");
        // ^ throws an error and re-applies the data back into the fields if available
        exit();
    }

    mysqli_query($connection, "UPDATE users SET email='" . $newEmail . "' WHERE id=" . $_SESSION['id'] . "");
    header("Location: account.php");
    exit();
}
