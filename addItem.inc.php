<?php
session_start();
?>
<?php
/**
 * addItem.inc.php, this script is responsible for creating tasks and adding them into the tasks table.
 * Created by Callum-James Smith (cs18804)
 */

require 'db.php';

if (isset($_POST['add-task'])) {
    require_once 'functions.inc.php';

    $ProjectTitle = $_GET['add-task'];

    $title = strip_tags($_POST['title']);
    $date = $_POST['task-date'];
    $time = $_POST['task-time'];
    $priority = $_POST['task-priority'];
    $desc = strip_tags($_POST['task-desc']);

    if (empty($title) || empty($date) || empty($priority) || empty($desc)) {
        echo ("You are missing items!");
        header("Location: landing.php?error=missingitems&projects=" . ProjectID());
        exit();
    }

    $TitleQuery = mysqli_query($connection, "SELECT task_title FROM tasks WHERE task_title='" . $title . "'");
    $TitleRowNum = mysqli_num_rows($TitleQuery);

    if ($TitleRowNum > 0) {
        header("Location: landing.php?error=nametaken&projects=" . ProjectID());
        exit();
    }

    $ProjectID = "SELECT * FROM projects,users WHERE user_id=" . $_SESSION['id'] . " AND projectID=users.last_project";
    $projectID_result = $connection->query($ProjectID);
    $projectID_row = $projectID_result->fetch_assoc();
    $ID = intval($projectID_row['last_project']);

    $sql = "SELECT projectID FROM tasks WHERE projectID='" . $_GET['add-item'] . "'";
    $ProjectIDQuery = mysqli_query($connection, $sql);
    $ProjectIDRows = mysqli_num_rows($ProjectIDQuery);

    mysqli_query($connection, "INSERT INTO tasks(projectID,task_title,task_date,task_time,task_state,task_priority,task_desc) VALUES('" . $ID . "','" . $title . "','" . $date . "', '" . $time . "', 'To Do', '" . $priority . "', '" . $desc . "')");

    $titleSQL = mysqli_query($connection, "SELECT task_title FROM tasks WHERE projectID='" . $_GET['add-item'] . "'");


    $titleString = '
    <div class="item">

        <div class="title-wrapper">

            <div class="task-title">
                <h1 class="taskTitle">' . $title . '</h1>
            </div>

            <div class="task-priority">
                <p class="task-priority">' . $priority . '</p>
            </div>

        </div>
        <hr class="taskTitle">

        <div class="task-desc">
            <p class="task-desc">' . $desc . '</p>
        </div>

        <div class="task-date-time">
            <p class="task-date-time">' . $date . ' ' . $time . '</p>
        </div>

    </div>';
    $_SESSION['newItem'] = $titleString;
    $_SESSION['item-added'] = true;

    $ProjectID = "SELECT * FROM projects,users WHERE user_id=" . $_SESSION['id'] . " AND projectID=users.last_project";
    $projectID_result = $connection->query($ProjectID);
    $projectID_row = $projectID_result->fetch_assoc();
    if ($projectID_row['last_project'] == null) {
        include_once 'functions.inc.php';
        $ID = ProjectID();
    } else {
        $ID = intval($projectID_row['last_project']);
    }

    header("Location: landing.php?projects=$ID");
    exit();
}
