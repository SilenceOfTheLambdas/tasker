<!-- 
    Tasker.io
    A task management system
    This is the landing page, after the user has logged in.
    Created by: Callum-James Smith (cs18804)
 -->
<!DOCTYPE html>
<!-- Checks to see if the user has a session -->
<?php 
    session_start();
    if (!isset($_SESSION['name'])) {
        header("Location: index.php?error=nosession");
        exit();
    }
?>
<head>

    <!-- Meta stuffs -->
    <meta type='description' content='A task management website.'>

    <!-- CSS -->
    <link rel='stylesheet' href="css/main.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <title>Task Manager</title>

</head>

<body>

    <header>
        <div id="logo">
            <!-- Logo goes here -->
            <h1 class="logo">Tasker.io</h1>
        </div>
        
        <div class="project-selector">
                <?php 
                    include 'functions.inc.php';
                    ProjectSelector();
                ?>
        </div>

        <div class="new-project">
            <a href="#openModalProject" id="open-modal-project"><button><i class="fas fa-plus"></i></button></a>
        </div>

        <div id="openModalProject" style="display: none;" class="modalDialog">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h1>New Project</h1>
                <?php 
                    echo(
                        '<form class="add-item" action="newProject.inc.php" method="post">
                            <h3>Please make a new project</h3>
                            <input type="text" name="project-name" placeholder="Project name...">
                            <button type="submit" name="add-project">Add Project</button>
                        </form>'
                    );
                ?>
            </div>
            </div>

        <div id="search">
            <!-- search goes here -->
        </div>
        
        <div id="user">

            <?php 
                echo("<p id='userHello'>Hello, </p>".$_SESSION['name']); ?>

        </div>

        <div id="signout">
            <form action="signout.inc.php" method="post">
                <button class="signout" type="submit" name="signout">Sign Out</button>
            </form>
        </div>

    </header>

    <div class="container">

        <div class="to-do-container-wrapper">

            <h3 class="headerTitle">To Do</h3>
            <hr>

			<div class="box-1"> <!-- TODO Box -->
            	<?php 
                /**
                 * This part checks to see if the user has any projects, if not they are forced to make one.
                 */

                    CheckProjects();
                    EditTask();
                    
                    if (isset($_GET['delete-task'])) {
                        require 'db.php';

					
                        $TaskTitle = $_GET['delete-task'];
                        
                        $sql = mysqli_query($connection, "DELETE FROM tasks WHERE task_title='".$TaskTitle."'");
					
						
					}
	
                    if (empty($_GET['projects'])) {
                        $ProjectID = mysqli_query($connection, "SELECT * FROM projects WHERE user_id='".$_SESSION['id']."'");
                    }else {
                        $ProjectID = mysqli_query($connection, "SELECT * FROM projects WHERE project_name='".$_GET['projects']."'");
                    }

                    $Project_ID = mysqli_fetch_assoc($ProjectID); // This variable stores all of the data performed from the query above, into a nice little array.
					$ID = intval($Project_ID['projectID']); // THIS IS THE ID!
                    $_SESSION['project-id'] = $ID;

                    // Stores the users last selected project in a table
                    $StoreLastSelectedObject = mysqli_query($connection, "UPDATE users SET last_project = '".$ID."' WHERE id=".$_SESSION['id']."");

                    $last_project_sql = "SELECT last_project FROM users WHERE id=".$_SESSION['id'].""; // Selects the project ID
                    $last_project_result = $connection-> query($last_project_sql);
                    $last_project_row = $last_project_result-> fetch_assoc();
                    $LastSelectedProject = $last_project_row['last_project'];

                    $sql = "SELECT task_title,task_date,task_time,task_state,task_priority,task_desc FROM tasks WHERE projectID=".intval($LastSelectedProject)." AND task_state='To Do' ORDER BY tasks.task_date ASC";
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
                            $task_date = date('D-d-M-Y', strtotime($row['task_date']));
                            $task_time = $row['task_time'];
                            
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
                    
                        </div>');
                        }
                    } ?>
			
			</div>

				<div class="addItem">  <!-- This holds the add item div-->
					
					<a href="#openModal" id="open-modal"><button class="add-item-button" id="add-item"><i class="far fa-plus-square"></i></button></a> <!-- button to activate modal -->
                    
                    <div id="openModal" class="modalDialog" style="display: none;"> <!-- The modal box that holds everything -->
                        <div> <!-- the element inside -->
                            <a href="#close" title="Close" class="close">X</a> <!-- The close button -->
                            <h1>Add Task</h1>
                            <?php 
                                AddTask();
                            ?>
                        </div>
                    </div>
					
				</div>
            </div>


        <div class="completed-container-wrapper">
            <h3 class="headerTitle">Completed</h3>
            <hr>
            <div class="box-3"> <!-- Completed Box -->
                   <?php

                    date_default_timezone_set('UTC');
                    if (empty($_GET['projects'])) {
                        $ProjectID = mysqli_query($connection, "SELECT * FROM projects WHERE user_id='".$_SESSION['id']."'");
                    }else {
                        $ProjectID = mysqli_query($connection, "SELECT * FROM projects WHERE project_name='".$_GET['projects']."'");
                    }
                    $Project_ID = mysqli_fetch_assoc($ProjectID); // This variable stores all of the data performed from the query above, into a nice little array.
                    $ID = intval($Project_ID['projectID']); // THIS IS THE ID!
                    $_SESSION['project-id'] = $ID;

                    // Stores the users last selected project in a table
                    $StoreLastSelectedObject = mysqli_query($connection, "UPDATE users SET last_project = '".$ID."' WHERE id=".$_SESSION['id']."");

                    $last_project_sql = "SELECT last_project FROM users WHERE id=".$_SESSION['id'].""; // Selects the project ID
                    $last_project_result = $connection-> query($last_project_sql);
                    $last_project_row = $last_project_result-> fetch_assoc();
                    $LastSelectedProject = $last_project_row['last_project'];

                    $sql = "SELECT * FROM tasks WHERE projectID=".intval($LastSelectedProject)." AND task_state='Completed'";
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
                            $task_date = date('D-d-M-Y', strtotime($row['task_date']));
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
                    
                        </div>');
                            
                        }
                    } ?>
            </div>
        </div>

    </div>

</body>
<script>
document.getElementById("open-modal").onclick = function() // Stop the modal boxes from appearing quickly every time the page is refreshed
{
    var modal = document.getElementById("openModal");
    modal.style.display = 'block';
}
document.getElementById("open-modal-project").onclick = function() // Stop the modal boxes from appearing quickly every time the page is refreshed
{
    var modal = document.getElementById("openModalProject");
    modal.style.display = 'block';
}
</script>
</html>