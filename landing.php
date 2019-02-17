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
					require 'db.php';
					$_SESSION['project_id'] = array();
                    if (empty($_GET['projects'])) {
                        $PROJECT_NAME_SQL = "SELECT * FROM projects WHERE user_id='".$_SESSION['id']."'";
                    } else {
                        $PROJECT_NAME_SQL = "SELECT project_name FROM projects WHERE user_id='".$_SESSION['id']."' ORDER BY project_name='".$_GET['projects']."' DESC";
                    }

                    $last_project_name_sql = "SELECT project_name FROM projects,users WHERE user_id='".$_SESSION['id']."' AND projectID=users.last_project"; // Selects the project ID
                    $last_project_name_result = $connection-> query($last_project_name_sql);
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
                ?>
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
        <div class="container-wrapper">
            <h3 class="headerTitle">To Do</h3>
            <hr>
			<div class="box-1"> <!-- TODO Box -->
            	<?php 
                /**
                 * This part checks to see if the user has any projects, if not they are forced to make one.
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
                                <input type="text" name="project-name">
                                <button type="submit" name="add-project">Add Project</button>
                            </form>'
                        );
                        exit();
                    }
                    if (isset($_GET['add-item'])) 
                    /**
                     * Checks to see if the user has selected the option to add a task.
                     * if so, then it prints out a form asking the user to fill in details about it.
                     * 
                     * Vars:
                     *  $TopForm = This contains the top part of the form including the <select> element.
                     *  $RestOfForm = This contains the rest of the form (from the project name list down).
                     */
                    {
                        
                        $TopForm = '<form class="add-item" action="addItem.inc.php" method="post">';

                        $RestOfForm = 
                                '
                                    <input type="text" name="title" placeholder="Title..."><br/>
                                    <input type="text" name="task-desc" placeholder="Description..."><br/>
                                    <input type="date" name="task-date"><br/>
                                    <input type="time" name="task-time"><br/>
                                <select name="task-state">
                                    <option name="To Do">To Do</option>
                                    <option name="In Progress">In Progress</option>
                                    <option name="Completed">Completed</option>
                                </select>
                                <select name="task-priority">
                                    <option name="high">High</option>
                                    <option name="medium">Medium</option>
                                    <option name="low">Low</option>
                                </select>
                                <button type="submit" name="add-task">Add Task</button>
                            </form>';
                        $ListOfProjects = mysqli_query($connection, "SELECT * FROM projects"); // The query that selects all of the data from table `projects`.

                        $row = mysqli_fetch_array($ListOfProjects); // This variable stores all of the data performed from the query above, into a nice little array.

                        $project_names[] = $row['project_name']; // Store a new variable that only stores values in the column 'project_name'.

                        echo($TopForm); // Prints out the top of the form
                        echo($RestOfForm); // prints out the rest if the form.
					}

					if (isset($_GET['edit-task'])) {
						require 'db.php';
					
						$TaskTitle = $_GET['edit-task'];
					
						// Obtain task details
						$sql = "SELECT * FROM tasks WHERE task_title='".$TaskTitle."'";
						$result = $connection-> query($sql);
						if ($result-> num_rows <= 0) {
							echo('<p>You Do Not Have Any Tasks</p>');
						}
						$row = $result-> fetch_assoc();
						$task_id = $row['task_id'];
						$task_priority = $row['task_priority'];
						$task_desc = $row['task_desc'];
						$task_date = $row['task_date'];
						$task_time = $row['task_time'];
						$task_state = $row['task_state'];
					
						
						$FormString = '
							<form action="edit-task.inc.php" method="get">
								<input type="text" name="title" value="'.$TaskTitle.'" placeholder="Title..."><br/>
								<input type="text" name="task-desc" value="'.$task_desc.'" placeholder="Description..."><br/>
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
								<button type="submit" name="finnish-edit" value="'.$task_id.'">Finnish</button>
							</form>';
					
						echo($FormString);
					
						
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
                    $StoreLastSelectedObject = mysqli_query($connection, "UPDATE users SET last_project = '".$ID."' WHERE users.id='".$_SESSION['id']."'");

                    $last_project_sql = "SELECT last_project FROM users WHERE id='".$_SESSION['id']."'"; // Selects the project ID
                    $last_project_result = $connection-> query($last_project_sql);
                    $last_project_row = $last_project_result-> fetch_assoc();
                    $LastSelectedProject = $last_project_row['last_project'];

                    $sql = "SELECT task_title,task_date,task_time,task_state,task_priority,task_desc FROM tasks WHERE projectID=".intval($LastSelectedProject)." ORDER BY tasks.task_date ASC";
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
								<button type="submit" name="edit-task" value="'.$task_title.'"><span class="edit-task"><i class="fas fa-pencil-alt"></i></span></button>
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
                    }

				?>
			
			</div>
				<div class="addItem">

					<form action="landing.php" method="get">
						<button class="add-item-button" type="submit" name="add-item" id="add-item"><i class="far fa-plus-square"></i></button>
					</form>

				</div>
            </div>
        <div class="container-wrapper">
            <h3 class="headerTitle">In Progress</h3>
            <hr>
            <div class="box-2"> <!-- IN PROGRESS Box -->

            </div>
        </div>

        <div class="container-wrapper">
            <h3 class="headerTitle">Completed</h3>
            <hr>
            <div class="box-2"> <!-- Completed Box -->

            </div>
        </div>

    </div>

</body>

</html>