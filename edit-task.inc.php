<?php

require 'db.php';
session_start();

$Task_Title = $_GET['title'];
$Task_Desc = $_GET['task-desc'];
$Task_Date = $_GET['task-date'];
$Task_Time = $_GET['task-time'];
$Task_State = $_GET['task-state'];
$Task_Priority = $_GET['task-priority'];
$Task_ID = intval($_GET['finish-edit']);

$ProjectID = "SELECT * FROM projects,users WHERE user_id=".$_SESSION['id']." AND projectID=users.last_project";
$projectID_result = $connection-> query($ProjectID);
$projectID_row = $projectID_result-> fetch_assoc();
$ID = intval($projectID_row['last_project']);

$sql = "SELECT * FROM projects WHERE user_id=".$_SESSION['id']." AND projectID=$ID";
$result = $connection-> query($sql);
$row = $result-> fetch_assoc();
$Project_Name = $row['project_name'];

if (preg_match("/^[a-zA-Z0-9]*\d$/", $Task_Title)) {
    header("Location: landing.php?invalidname&projects=$Project_Name");
    exit();
}else {
    $sql = mysqli_query($connection, "UPDATE tasks SET task_title='".$Task_Title."',task_date='".$Task_Date."',task_time='".$Task_Time."',task_state='".$Task_State."',task_priority='".$Task_Priority."',task_desc='".$Task_Desc."' WHERE task_id=".$Task_ID."");

    header("Location: landing.php?itemupdated&projects=$Project_Name");
    exit();
}
