<?php

require 'db.php';

if (isset($_POST['add-task'])) {
    session_start();

    $title = $_POST['title'];
    $date = $_POST['task-date'];
    $time = $_POST['task-time'];
    $state = $_POST['task-state'];
    $priority = $_POST['task-priority'];
    $desc = $_POST['task-desc'];

    if (empty($title) || empty($date) || empty($state) || empty($priority) || empty($desc)) {
        echo("You are missing items!");
        header("Location: landing.php?error=missingitems&title=".$title."&date=".$date."&state=".$state."&priority=".$priority."&desc=".$desc);
        exit();
    }

    $ProjectID = mysqli_query($connection, "SELECT projectID FROM projects WHERE user_id='".$_SESSION['id']."'");
    $Project_ID = mysqli_fetch_assoc($ProjectID); // This variable stores all of the data performed from the query above, into a nice little array.
    $ID = $Project_ID['projectID']; // THIS IS THE ID!

    $sql = "SELECT projectID FROM tasks WHERE projectID='".$Project_ID."'";
    $ProjectIDQuery = mysqli_query($connection, $sql);
    $ProjectIDRows = mysqli_num_rows($ProjectIDQuery);

    mysqli_query($connection, "INSERT INTO tasks(projectID,task_title,task_date,task_time,task_state,task_priority,task_desc) VALUES('".$ID."','".$title."','".$date."', '".$time."', '".$state."', '".$priority."', '".$desc."')");

    $titleSQL = mysqli_query($connection, "SELECT task_title FROM tasks WHERE projectID='".$ID."'");
    

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
    header("Location: landing.php?item-added?");
    exit();

}

