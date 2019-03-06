<?php
session_start();

if (isset($_GET['account-del'])) {

    require 'db.php';

    $sql = "DELETE FROM tasks WHERE projectID=(SELECT projectID FROM projects WHERE user_id=".$_SESSION['id'].")";

    mysqli_query($connection, $sql);
    mysqli_query($connection, "DELETE FROM projects WHERE user_id=".$_SESSION['id']."");
    mysqli_query($connection, "DELETE FROM users WHERE id=".$_SESSION['id']."");
    echo("Finished!");
    
    session_destroy();
    header("Location: index.php");
}