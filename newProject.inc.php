<?php
session_start();
?>
<?php 
/**
 * newProject.inc.php, this is responsible for making new projects and adding them to the database.
 * Created by Callum-James Smith (cs18804)
 */
require 'db.php';

if (isset($_POST['add-project'])) {

    if (empty($_POST['project-name'])) {
        echo ("Please enter a project name.");
        header("Location: landing.php?error=noprojectname");
        exit();
    }

    include_once "functions.inc.php";
    $Project = ProjectID();

    $project_name = $_POST['project-name'];
    $userID = $_SESSION['id'];

    $ProjectID = "SELECT * FROM projects,users WHERE user_id=" . $_SESSION['id'] . " AND projectID=users.last_project";
    $projectID_result = $connection->query($ProjectID);
    $projectID_row = $projectID_result->fetch_assoc();
    $ID = intval($projectID_row['last_project']);

    mysqli_query($connection, "INSERT INTO projects(project_name, user_id) VALUES('" . $project_name . "','" . $userID . "')");

    $sql = "SELECT * FROM projects WHERE user_id=" . $_SESSION['id'] . " AND project_name='" . $project_name . "'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $ProjectID = $row['projectID'];

    header("Location: landing.php?projects=$ProjectID");
    exit();
}
