<?php

if (isset($_GET['finnish-edit'])) {
    require 'db.php';
    
    $Task_Title = $_GET['title'];
    $Task_Desc = $_GET['task-desc'];
    $Task_Date = $_GET['task-date'];
    $Task_Time = $_GET['task-time'];
    $Task_State = $_GET['task-state'];
    $Task_Priority = $_GET['task-priority'];

    $sql = mysqli_query($connection, "UPDATE tasks SET task_title='".$Task_Title."',task_date='".$Task_Date."',task_time='".$Task_Time."',task_state='".$Task_State."',task_priority='".$Task_Priority."',task_desc='".$Task_Desc."' WHERE task_id=".intval($_GET['finnish-edit'])."");

    header("Location: landing.php?itemupdated");
    exit();
}