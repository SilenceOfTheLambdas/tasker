<?php 

require 'db.php';

if (isset($_POST['add-project'])) {

    if (empty($_POST['project-name'])) {
        echo("Please enter a project name.");
        header("Location: landing.php?error=noprojectname");
        exit();
    }

    session_start();
    include_once "functions.inc.php";
    $Project = Project_Name();

    $project_name = $_POST['project-name'];
    $userID = $_SESSION['id'];

    mysqli_query($connection, "INSERT INTO projects(project_name, user_id) VALUES('".$project_name."','".$userID."')");
    header("Location: landing.php?projects=$Project");
    exit();
    
}