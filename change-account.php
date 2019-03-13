<?php
require_once 'db.php';
session_start();
if (isset($_GET['new-name'])) {

    $newName = $_GET['new-name'];

    mysqli_query($connection, "UPDATE users SET name='" . $newName . "' WHERE id=" . $_SESSION['id'] . "");
    header("Location: account.php");
    exit();
} else if (isset($_GET['new-email'])) {

    $newEmail = $_GET['new-email'];

    mysqli_query($connection, "UPDATE users SET email='" . $newEmail . "' WHERE id=" . $_SESSION['id'] . "");
    header("Location: account.php");
    exit();
}
