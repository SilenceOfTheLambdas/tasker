<?php

require 'db.php';

if (isset($_POST['add-task'])) {
    session_start();

    $id = $_POST['project-id'];
    $title = $_POST['title'];
    $date = $_POST['task-date'];
    $time = $_POST['task-time'];
    $state = $_POST['task-state'];
    $priority = $_POST['task-priority'];
    $desc = $_POST['task-desc'];

    $sql = "SELECT projectID FROM tasks WHERE projectID='".$id."'";
    $ProjectIDQuery = mysqli_query($connection, $sql);
    $ProjectIDRows = mysqli_num_rows($ProjectIDQuery);

    if ($ProjectIDRows <= 0) {
        echo("A project with this ID does not exist!");
        header("Location: landing.php?error=projectDoesNotExist");
        exit();
    }

    mysqli_query($connection, "INSERT INTO tasks(projectID,task_title,task_date,task_time,task_state,task_priority,task_desc) VALUES('".$id."','".$title."','".$date."', '".$time."', '".$state."', '".$priority."', '".$desc."')");

    $titleString ='
    <div class="item">

        <div class="title-wrapper">

            <div class="task-title">
                <h1 class="taskTitle">'.$title.'</h1>
            </div>

            <div class="task-priority">
                <p class="task-priority">'.$priority.'</p>
            </div>

        </div>
        <hr class="taskTitle">

        <div class="task-desc">
            <p class="task-desc">'.$desc.'</p>
        </div>

        <div class="task-date-time">
            <p class="task-date-time">'.$date.' '.$time.'</p>
        </div>

    </div>';
    $_SESSION['newItem'] = $titleString;
    $_SESSION['item-added'] = true;
    header("Location: landing.php?item-added");
    exit();

}

