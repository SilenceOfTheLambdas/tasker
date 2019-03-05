<?php
/**
 * functions.inc.php, a place for all functions that will be used.
 * Created by: Callum-James Smith (cs18804)
 */
require 'db.php';

if (isset($_GET['delete-project'])) {
    DeleteProject();
}

function Project_Name() {
    require 'db.php';

    $ProjectID = "SELECT * FROM projects,users WHERE user_id=".$_SESSION['id']." AND projectID=users.last_project";
    $projectID_result = $connection-> query($ProjectID);
    $projectID_row = $projectID_result-> fetch_assoc();
    $ID = intval($projectID_row['last_project']);

    $sql = "SELECT * FROM projects WHERE user_id=".$_SESSION['id']." AND projectID=$ID";
    $result = $connection-> query($sql);
    $row = $result-> fetch_assoc();
    $Project_Name = $row['project_name'];

    return $Project_Name;
}

function LoginForm() {
/**
 * function LoginForm(), this function provides the form that the user fills in to sign-in.
 * 
 * Vars:
 *  $_GET['error']  :   Obtained from the form located at index.php, says if an error has occurred.
 *  $_GET['email']  :   Obtained from the form located at index.php, provided if only if an email is passed in.
 *  $_GET['emptyemail'] :   Obtained from the form located at index.php, provided if the user DOES NOT enter an email.
 */

    if (isset($_GET['error'])) // If there is an error
    {
        if (isset($_GET['email'])) // If email is passed on
        {
            echo('<input type="email" style="margin-bottom: 20px;" name="email" id="email" value="'.$_GET['email'].'" placeholder="Email..."><br/>');
            echo('<input style="border-color: red;" type="password" name="password" id="password" placeholder="Incorrect password..."><br>');
        }
        else // if not return form as normal
        {
            echo('<input type="email" style="margin-bottom: 20px;" name="email" id="email" placeholder="Email..."><br/>');
            echo('<input type="password" name="password" id="password" placeholder="Password..."><br>');
        }
    }
    elseif (isset($_GET['emptyemail'])) // If the user does not enter an email
    {
        echo('<input style="border-color: red; margin-bottom: 20px;" type="email" name="email" id="email" placeholder="Please enter email..."><br/>');
        echo('<input type="password" name="password" id="password" placeholder="Password..."><br>');
    }
    else // Otherwise, print form normally
    {
        echo('<input type="email" style="margin-bottom: 20px;" name="email" id="email" placeholder="Email..."><br/>');
        echo('<input type="password" name="password" id="password" placeholder="Password..."><br>');
    }
}

function SignUpForm() {
/**
 * function SignUpForm(), this function provides a form that the user fills in to sign-up.
 * 
 * Vars:
 *  $_GET['error']  :   Obtained from the form located at signup.php, says if an error has occurred.
*/

    if (isset($_GET['error'])) // If there is an error
    {
        if ($_GET['error'] == "invalidname") // If that error is equal to 'invalidname'
        {
            echo('<input style="border-color: red;" type="text" style="margin-bottom: 20px;" name="name" placeholder="Invalid Name..."><br>');
            echo('<input type="email" style="margin-bottom: 20px;" value="'.$_GET['email'].'" name="email" placeholder="Email..."><br>');
        } else // Otherwise, print name and email form normally
        {
            echo('<input type="text" style="margin-bottom: 20px;" name="name" placeholder="Name..."><br>');
            echo('<input type="email" style="margin-bottom: 20px;" name="email" placeholder="Email..."><br>');
        }
    } 
    else // if there is no error, print name an email normally
    {
        echo('<input type="text" style="margin-bottom: 20px;" name="name" placeholder="Name..."><br>');
        echo('<input type="email" style="margin-bottom: 20px;" name="email" placeholder="Email..."><br>');
    }
}

function ProjectSelector() {
/**
 * function ProjectSelector(), this function is used to provide the user with a dropdown list of projects that belong to them.
 * 
 * Vars:
 *  $_SESSION['project_id'] :   The project ID that is stored in a $_SESSION variable.
 *  $PROJECT_NAME_SQL   :   This is the SQL query string that is used to fond all data stored in the table *projects*. This values varies *  depending on whether $_GET['projects'] is given.
 * 
 *  $_SESSION['id'] :   This is the user's ID that is assigned from login.in.php.
 *  $last_project_name_sql  :   Stores a query that will select the project ID from the user's last selected project.
 */
    require 'db.php';
                        
    if (empty($_GET['projects'])) // If the project name is not passed on in the URL
    {
        $PROJECT_NAME_SQL = "SELECT * FROM projects WHERE user_id='".$_SESSION['id']."'"; // The query will show all projects according to the user ID
    } 
    elseif (isset($_GET['projects'])) {
        // If it's not empty, then it will print out the options with the last selected project at the top
        $PROJECT_NAME_SQL = "SELECT project_name FROM projects WHERE user_id='".$_SESSION['id']."' ORDER BY project_name='".$_GET['projects']."' DESC";
    }

    $last_project_name_sql = "SELECT * FROM projects,users WHERE user_id='".$_SESSION['id']."' AND projectID=users.last_project"; // Selects the project ID
    $last_project_name_result = $connection-> query($last_project_name_sql); // Stores the result
    $last_project__name_row = $last_project_name_result-> fetch_assoc();
    $LastSelectedProjectName = $last_project__name_row['project_name'];
    $PROJECT_NAME_RESULT = $connection-> query($PROJECT_NAME_SQL);

    echo('
    <form name="ProjectSelection" action="landing.php" method="get">
        <select name="projects" value="'.$LastSelectedProjectName.'" id="project_selector" onchange="this.form.submit()">
    ');
    while ($PROJECT_NAME_ROW = $PROJECT_NAME_RESULT-> fetch_assoc()) {
        $project_title = $PROJECT_NAME_ROW['project_name'];
        echo('<option value="'.$project_title.'" >'.$project_title.'</option>');
    }
    echo('</select></form>');
}

function CheckProjects() {
/**
 * function CheckProjects(), checks to see if the user has any projects, if they don't they are forced to make one.
 * 
 * Vars:
 *  $ProjectSQL :   The SQL string query that finds the projects names that belong to the user.
 *  $Project_Name   :   Parses the SQL query.
 *  $ProjectNameRows    :   Stores the number of rows that show from the SQL query.
 */
    require 'db.php';

    $ProjectSQL = "SELECT project_name FROM projects WHERE user_id='".$_SESSION['id']."'";
    $Project_Name = mysqli_query($connection, $ProjectSQL);
    $ProjectNameRows = mysqli_num_rows($Project_Name);

    if ($ProjectNameRows <= 0) // If the user does not have any projects, they are forced to make one
    {
        echo(
            '<form class="add-item" action="newProject.inc.php" method="post">
                <h3>Please make a new project</h3>
                <input style="background-color: #ffff;" type="text" name="project-name">
                <button type="submit" name="add-project">Add Project</button>
            </form>'
        );
        exit();
    }
}

function EditTask() {
/**
 * function EditTask(), this is used to provide a form the user can fill in to add a new task.
 * 
 *  Vars:
 *  $_GET['edit-task']  :   This is the name of the task, passed on from the edit button located on the task
 *  $TaskTitle  :   This the variable that stores the string value, just used to make things easier to read
 */
    if (isset($_GET['edit-task'])) {
        require 'db.php';
    
        $TaskTitle = $_GET['edit-task'];
    
        // Obtain task details
        $sql = "SELECT * FROM tasks WHERE task_title='".$TaskTitle."'";
        $result = $connection-> query($sql);
        if ($result-> num_rows <= 0) {
            // If the user does NOT have any tasks
            echo('<p>You Do Not Have Any Tasks</p>');
        }

        // Gets all of the data about the task
        $row = $result-> fetch_assoc();
        $task_id = $row['task_id'];
        $task_priority = $row['task_priority'];
        $task_desc = $row['task_desc'];
        $task_date = $row['task_date'];
        $task_time = $row['task_time'];
        $task_state = $row['task_state'];
        
        $FormString = '
            <form class="edit-item" action="edit-task.inc.php" method="get">
                <input type="text" name="title" value="'.$TaskTitle.'" placeholder="Title..."><br/>
                <textarea class="description" name="task-desc" cols="26" rows="6" placeholder="Description...">'.$task_desc.'</textarea><br/>
                <input type="date" name="task-date" value="'.$task_date.'"><br/>
                <input type="time" name="task-time" value="'.$task_time.'"><br/>
                <select name="task-state" value="'.$task_state.'">
                    <option name="To Do">To Do</option>
                    <option name="In Progress">In Progress</option>
                    <option name="Completed">Completed</option>
                </select>
                <select name="task-priority" value="'.$task_priority.'">
                    <option name="high">High</option>
                    <option name="medium">Medium</option>
                    <option name="low">Low</option>
                </select>
                <button type="submit" name="finish-edit" value="'.$task_id.'">Finish</button>
            </form>';
    
        echo($FormString);  
    }
}

function AddTask() {
/**
 * function AddTask(), this displays a pop-up box that will allow users to add tasks.
 * 
 *  Vars:
 *  $NameTaken  :   Initialized with an empty string at first, but is used to store the string that prints out an error
 *  $_GET['error']  :   Passed on of there is an error, in this case; if the user has chose a task name that already exists
 */

    $NameTaken = "";
    if (isset($_GET['error'])) {
        if (strcmp($_GET['error'], "nametaken")) {
            $NameTaken = "<p>Name Taken in project!<p>";
        }
    }
    echo('<form class="add-item" action="addItem.inc.php" method="post">
            '.$NameTaken.'
            <input type="text" name="title" placeholder="Title..."><br/>
            <textarea class="description" name="task-desc" cols="26" rows="6" placeholder="Description..."></textarea><br/>
            <input type="date" name="task-date" placeholder="Choose a due date.."><br/>
            <input type="time" name="task-time"><br/>

            <select name="task-priority">
                <option name="high">High</option>
                <option name="medium">Medium</option>
                <option name="low">Low</option>
            </select>

            <button type="submit" name="add-task">Add Task</button>

        </form>');
}

function LastSelectedProject() {
/**
 * function LastSelectedProject(), This gets the name of the last project selected
 */

    require 'db.php';

    $ProjectID = mysqli_query($connection, "SELECT * FROM projects WHERE user_id='".$_SESSION['id']."' AND project_name='".$_GET['projects']."'");

    $Project_ID = mysqli_fetch_assoc($ProjectID); // This variable stores all of the data performed from the query above, into a nice little array.
    $ID = intval($Project_ID['projectID']); // THIS IS THE ID!

    // Stores the users last selected project in a table
    $StoreLastSelectedObject = mysqli_query($connection, "UPDATE users SET last_project = '".$ID."' WHERE id=".$_SESSION['id']."");

    $last_project_sql = "SELECT last_project FROM users WHERE id=".$_SESSION['id'].""; // Selects the project ID
    $last_project_result = $connection-> query($last_project_sql);
    $last_project_row = $last_project_result-> fetch_assoc();
    $LastSelectedProject = $last_project_row['last_project'];

    $returnSQL = mysqli_query($connection, "SELECT projectID FROM projects,users WHERE id=".$_SESSION['id']."");
    $returnROW = $returnSQL-> fetch_assoc();
    $return = $returnROW['projectID'];

    if (!$LastSelectedProject) {
        echo('No Project Exists!');
        $LastSelectedProject = $return;
    }

    return $LastSelectedProject;
}

function PrintCompletedTasks() {

    require 'db.php';

    date_default_timezone_set('UTC'); // Sets the date to UTC timezone
    $LastSelectedProject = LastSelectedProject();

    $sql = "SELECT * FROM tasks,users WHERE projectID=".intval($LastSelectedProject)." AND task_state='Completed' AND users.id=".$_SESSION['id']."";
    $result = $connection-> query($sql);

    if ($result-> num_rows <= 0) {
        // if the user does not have any completed tasks
        echo('<p>No tasks completed yet</p>');
    }
    if ($result-> num_rows > 0) {
        while ($row = $result-> fetch_assoc()) // While there is data in the table
        {
            // Gets all of the data about the task
            $task_title = $row['task_title'];
            $task_priority = $row['task_priority'];
            $task_desc = $row['task_desc'];
            $task_date = date('D-d-M-Y', strtotime($row['task_date'])); // Converts the date format to something better
            $task_time = $row['task_time'];
            $TaskState = $row['task_state'];
            echo('
            <div class="item">

                <div class="title-wrapper">
        
                    <div class="task-title">
                        <del><h1 class="taskTitle">'.$task_title.'</h1></del>
                    </div>
        
                    <div class="task-priority">
                        <del><p class="task-priority">'.$task_priority.'</p></del>
                    </div>
                    
                    <form action="landing.php" method="get">
                        <input name="projects" value="'.Project_Name().'" style="display: none;">
                        <button class="edit-buttons" type="submit" name="delete-task" value="'.$task_title.'"><span class="edit-task"><i class="fas fa-times"></i></span></button>
                    </form>

                </div>
                <hr class="taskTitle">
        
                <div class="task-desc">
                    <del><p class="task-desc">'.$task_desc.'</p></del>
                </div>
        
                <div class="task-date-time">
                    <del><p class="task-date-time">'.$task_date.' '.$task_time.'</p></del>
                </div>

                <div class="u-button-holder">
                    <form action="landing.php" method="get">
                        <input name="projects" value="'.Project_Name().'" style="display: none;">
                        <button class="undo-buttons" type="submit" name="undo-task" value="'.$task_title.'"><span class="complete-task"><i class="fas fa-arrow-left"></i></span></button>
                    </form>
                </div>
        
            </div>');
            }
            
        }
}

function PrintTasks($type) {

    require 'db.php';

    $LastSelectedProject = LastSelectedProject();

    if ($type == 'priority-desc') {
        $sql = "SELECT * FROM tasks,users WHERE (projectID=".intval($LastSelectedProject)." AND task_state='To Do' AND users.id=".intval($_SESSION['id']).") ORDER BY tasks.task_priority DESC";
    } 
    else if ($type == 'priority-asc') {
        $sql = "SELECT * FROM tasks,users WHERE (projectID=".intval($LastSelectedProject)." AND task_state='To Do' AND users.id=".intval($_SESSION['id']).") ORDER BY tasks.task_priority ASC";
    }
    else if ($type == 'date-desc') {
        $sql = "SELECT * FROM tasks,users WHERE (projectID=".intval($LastSelectedProject)." AND task_state='To Do' AND users.id=".intval($_SESSION['id']).") ORDER BY tasks.task_date DESC";
    }
    else if ($type == 'date-asc') {
        $sql = "SELECT * FROM tasks,users WHERE (projectID=".intval($LastSelectedProject)." AND task_state='To Do' AND users.id=".intval($_SESSION['id']).") ORDER BY tasks.task_date ASC";
    }
    else {
        $sql = "SELECT * FROM tasks,users WHERE (projectID=".intval($LastSelectedProject)." AND task_state='To Do' AND users.id=".intval($_SESSION['id']).") ORDER BY tasks.task_date ASC";
    }
    
    $result = $connection-> query($sql);

    if ($result-> num_rows <= 0) {
        echo('<p>You Do Not Have Any Tasks</p>');
    }
    if ($result-> num_rows > 0) {
        while ($row = $result-> fetch_assoc()) // While there is data in the table
        {
            $task_title = $row['task_title'];
            $task_priority = $row['task_priority'];
            $task_desc = $row['task_desc'];
            $task_date = $row['task_date'];
            $task_state = $row['task_state'];
            $task_date = date('D-d-M-Y', strtotime($row['task_date'])); // Reformats the time
            $task_time = $row['task_time'];
            
            if ($task_priority == "High") {
                echo('
                <div class="item-high">

                    <div class="title-wrapper">
            
                        <div class="task-title">
                            <h1 class="taskTitle">'.$task_title.'</h1>
                        </div>
            
                        <div class="task-priority">
                            <p class="task-priority">'.$task_priority.'</p>
                        </div>
                        
                        <form action="landing.php" method="get">
                            <input name="projects" value="'.Project_Name().'" style="display: none;">
                            <button class="edit-buttons" type="submit" name="edit-task" value="'.$task_title.'"><span class="edit-task"><i class="fas fa-pencil-alt"></i></span></button>
                        </form>

                    </div>
                    <hr class="taskTitle">
            
                    <div class="task-desc">
                        <p class="task-desc">'.$task_desc.'</p>
                    </div>
            
                    <div class="task-date-time">
                        <p class="task-date-time">'.$task_date.' '.$task_time.'</p>
                    </div>

                <div class="c-button-holder">
                    <form action="landing.php" method="get">
                        <input name="projects" value="'.Project_Name().'" style="display: none;">
                        <button class="complete-buttons" type="submit" name="complete-task" value="'.$task_title.'"><span class="complete-task"><i class="fas fa-check"></i></span></button>
                    </form>
                </div>
            
                </div>');
            }
            elseif ($task_priority == "Medium") {
                echo('
                <div class="item-medium">

                    <div class="title-wrapper">
            
                        <div class="task-title">
                            <h1 class="taskTitle">'.$task_title.'</h1>
                        </div>
            
                        <div class="task-priority">
                            <p class="task-priority">'.$task_priority.'</p>
                        </div>
                        
                        <form action="landing.php" method="get">
                            <input name="projects" value="'.Project_Name().'" style="display: none;">
                            <button class="edit-buttons" type="submit" name="edit-task" value="'.$task_title.'"><span class="edit-task"><i class="fas fa-pencil-alt"></i></span></button>
                        </form>

                    </div>
                    <hr class="taskTitle">
            
                    <div class="task-desc">
                        <p class="task-desc">'.$task_desc.'</p>
                    </div>
            
                    <div class="task-date-time">
                        <p class="task-date-time">'.$task_date.' '.$task_time.'</p>
                    </div>

                    <div class="c-button-holder">
                        <form action="landing.php" method="get">
                            <input name="projects" value="'.Project_Name().'" style="display: none;">
                            <button class="complete-buttons" type="submit" name="complete-task" value="'.$task_title.'"><span class="complete-task"><i class="fas fa-check"></i></span></button>
                        </form>
                    </div>
            
                </div>');
            }
            else {
                echo('
                <div class="item">

                    <div class="title-wrapper">
            
                        <div class="task-title">
                            <h1 class="taskTitle">'.$task_title.'</h1>
                        </div>
            
                        <div class="task-priority">
                            <p class="task-priority">'.$task_priority.'</p>
                        </div>
                        
                        <form action="landing.php" method="get">
                            <input name="projects" value="'.Project_Name().'" style="display: none;">
                            <button class="edit-buttons" type="submit" name="edit-task" value="'.$task_title.'"><span class="edit-task"><i class="fas fa-pencil-alt"></i></span></button>
                        </form>

                    </div>
                    <hr class="taskTitle">
            
                    <div class="task-desc">
                        <p class="task-desc">'.$task_desc.'</p>
                    </div>
            
                    <div class="task-date-time">
                        <p class="task-date-time">'.$task_date.' '.$task_time.'</p>
                    </div>

                    <div class="c-button-holder">
                        <form action="landing.php" method="get">
                            <input name="projects" value="'.Project_Name().'" style="display: none;">
                            <button class="complete-buttons" type="submit" name="complete-task" value="'.$task_title.'"><span class="complete-task"><i class="fas fa-check"></i></span></button>
                        </form>
                    </div>
            
                </div>');
            }
        }
    }
}

function DeleteProject() {
/**
 * function DeleteProject(), This is called when the user request the deletion of a project.
 *  Vars:
 *  $sql    :   Stores the string that is executed in MySQL.
 *  $result :   Stores the result from the query.
 *  $row    :   Stores the value from the result into an indexed array.
 *  $Project_id :   Contains the integer value of the user's last selected project.
 * 
 *  $sql    :   This executes a query that deletes the row in table projects.
 */

    require 'db.php';
    session_start();

    $sql = "SELECT * FROM users WHERE id=".$_SESSION['id']."";
    $result = $connection-> query($sql);
    $row = $result-> fetch_assoc();
    $Project_id = intval($row['last_project']);

    $sql = mysqli_query($connection, "DELETE FROM projects WHERE projectID=".$Project_id."");

    header("Location: landing.php?project-deleted");
    exit();
}

function accountDetails($x) {
    require 'db.php';

    $sql = "SELECT name,email FROM users WHERE id=".$_SESSION['id']."";
    $result = $connection-> query($sql);
    $row = $result-> fetch_assoc();

    $name = $row['name'];
    $email = $row['email'];
    $nameh3 = "<h3>$name</h3>";
    $emailh3 = "<h3>$email</h3>";

    if ($x == "name") {
        return $nameh3;
    } 
    else {
        return $emailh3;
    }
    
}
