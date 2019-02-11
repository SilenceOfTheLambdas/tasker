<!-- 
    Tasker.io
    A task management system
    This is the landing page, after the user has logged in.
    Created by: Callum-James Smith (cs18804)
 -->
<!DOCTYPE html>
<!-- Checks to see if the user has a session -->
<?php 
    // session_start();
    // if (!isset($_SESSION['name'])) {
    //     header("Location: index.php?error=nosession");
    //     exit();
    // }
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
            <h1 class="logo">Task.io</h1>
        </div>

        <div id="search">
            <!-- search goes here -->
        </div>
        
        <div id="user">

            <?php 
                echo("<p id='userHello'>Hello, </p>"."<p>Callum</p>"); ?>

        </div>

        <div id="signout">
            <form action="signout.php" method="post">
                <button class="signout" type="submit" name="signout">Sign Out</button>
            </form>
        </div>

    </header>

    <div class="container">

        <div class="box-1"> <!-- TODO Box -->
            <h3 class="headerTitle">To Do</h3>
            <hr>
            <div class="item">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                Consequuntur pariatur quas consectetur adipisci vitae corporis fuga possimus est dolores a, 
                quod asperiores voluptas obcaecati eveniet ea aspernatur, mollitia doloremque porro.
            </div>

            <div class="item">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                Consequuntur pariatur quas consectetur adipisci vitae corporis fuga possimus est dolores a, 
                quod asperiores voluptas obcaecati eveniet ea aspernatur, mollitia doloremque porro.
            </div>

            <div class="addItem">
                <form action="addItem.php" method="post">
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