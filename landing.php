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

        <div class="box-1"> <!-- TODO Box -->
            <h3 class="headerTitle">To Do</h3>
            <hr>

            <?php 
            /**
             * This part checks to see if the user has any projects, if not they are forced to make one.
             */
                require 'db.php';

                $ProjectSQL = "SELECT project_name FROM projects WHERE user_id='".$_SESSION['id']."'";
                $Project_Name = mysqli_query($connection, $ProjectSQL);
                $ProjectNameRows = mysqli_num_rows($Project_Name);

                if ($ProjectNameRows <= 0) {
                    echo(
                        '<form action="newProject.inc.php" method="post">
                            <h3>Please make a new project</h3>
                            <input type="text" name="project-name">
                            <button type="submit" name="add-project">Add Project</button>
                        </form>'
                    );
                }

                if (isset($_POST['add-item'])) 
                /**
                 * Checks to see if the user has selected the option to add a task.
                 * if so, then it prints out a form asking the user to fill in details about it.
                 * 
                 * Vars:
                 *  $TopForm = This contains the top part of the form including the <select> element.
                 *  $RestOfForm = This contains the rest of the form (from the project name list down).
                 */
                {
                    
                    $TopForm = '<form action="addItem.inc.php" method="post">
                    <select name="project-names">';

                    $RestOfForm = 
                        '
                            </select>
                            Title<input type="text" name="title" placeholder="Title..."><br/>
                            Description<input type="text" name="task-desc" placeholder="Description..."><br/>
                            Date<input type="date" name="task-date"><br/>
                            Time<input type="time" name="task-time"><br/>
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

                    foreach ($project_names as $name) // loops through each item in the array.
                    {
                        echo('<option value="'.$name.'">'.$name.'</option>'); // then prints out an <option> tag with the name placed in.
                    }
                    echo($RestOfForm); // prints out the rest if the form.
                }

                $Tasks = "SELECT * FROM tasks ";
                $TasksQuery = mysqli_query($connection, $Tasks);
                $NumberOfTasks = mysqli_num_rows($TasksQuery);

                $ProjectID = mysqli_query($connection, "SELECT projectID FROM projects");
                $Project_ID = mysqli_fetch_assoc($ProjectID); // This variable stores all of the data performed from the query above, into a nice little array.
                $ID = $Project_ID['projectID']; // THIS IS THE ID!
                $TaskIDQuery = mysqli_query($connection, "SELECT task_id FROM tasks WHERE projectID='".$ID."'");
                $TaskIDAssoc = mysqli_fetch_assoc($TaskIDQuery);
                $TaskID = $TaskIDAssoc['task_id'];
                if (isset($_SESSION['item-added'])) {
                    // Prints out the new task once created
                    // echo($_SESSION['newItem']);
                }
                $sql = "SELECT task_title,task_date,task_time,task_state,task_priority,task_desc FROM tasks WHERE projectID='".$ID."' ORDER BY tasks.task_date ASC";
                $result = $connection-> query($sql);

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

            <div class="addItem">

                <form action="landing.php" method="post">
                    <button type="submit" name="add-item"><i class="far fa-plus-square"></i></button>
                </form>

            </div>

        </div>

        <div class="box-2"> <!-- IN PROGRESS Box -->
            <h3 class="headerTitle">In Progress</h3>
            <hr>
            <div class="item">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                Consequuntur pariatur quas consectetur adipisci vitae corporis fuga possimus est dolores a, 
                quod asperiores voluptas obcaecati eveniet ea aspernatur, mollitia doloremque porro.
            </div>
        </div>

        <div class="box-3"> <!-- COMPLETED Box -->
            <h3 class="headerTitle">Completed</h3>
            <hr>

            <div class="item">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                Consequuntur pariatur quas consectetur adipisci vitae corporis fuga possimus est dolores a, 
                quod asperiores voluptas obcaecati eveniet ea aspernatur, mollitia doloremque porro.
            </div>

        </div>

    </div>

</body>

</html>