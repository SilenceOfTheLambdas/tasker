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
            <div class="item">

                <div class="task-title">
                    <h1 class="taskTitle">Task Title</h1>
                    <hr class="taskTitle">
                </div>

                <div class="task-desc">
                    <p class="task-desc">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam, laboriosam! 
                    Hic earum cupiditate assumenda accusamus praesentium iure nisi error iusto.</p>
                </div>

            </div>

            <div class="item">

                <div class="title-wrapper">

                    <div class="task-title">
                        <h1 class="taskTitle">Task Title</h1>
                    </div>

                    <div class="task-priority">
                        <p class="task-priority">Medium</p>
                    </div>
                </div>
                <hr class="taskTitle">
                <div class="task-desc">
                    <p class="task-desc">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam, laboriosam! 
                    Hic earum cupiditate assumenda accusamus praesentium iure nisi error iusto.</p>
                </div>

                <div class="task-date-time">
                    <p class="task-date-time">14/02/2019</p>
                </div>

            </div>

            <?php 

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

                if (isset($_POST['add-item'])) {
                    echo(
                        '<form action="addItem.inc.php" method="post">
                            ''
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
                        </form>'
                    );
                }
                if (isset($_SESSION['newItem'])) {
                    echo($_SESSION['newItem']);
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