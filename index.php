<!-- 
    Tasker.io
    A task management system
    This is the login page.
    Created by: Callum-James Smith (cs18804)
    files indicated with *.inc.php are used to process the information, these contain only php no HTML
 -->
<!DOCTYPE html>
<!-- PHP Includes -->
<?php
    session_start();
    if (isset($_SESSION['name']) && isset($_SESSION['id'])) // If the user already has a session, log them in
    {
        header("Location: landing.php");
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
            <h1 class="logo">Task.io</h1>
        </div>
    </header>

    <div class="wrapper">
    
        <div class="loginBox">

            <form id="LoginForm" action="login.inc.php" method="post">

                <h1 id="Sign In" style="text-decoration: underline white;">Sign In</h1>
                <?php 
                    include 'functions.inc.php';
                    LoginForm();
                ?>

                <div class="formButtons">

                    <div class='signup'>
                        <form id="LoginForm" action="login.inc.php" method="post">
                            <button id='signin-button' type="submit" name="signin-submit">Sign In</button>
                        </form>
                    </div>

                    <div class="signup">
                        <form id="LoginForm" action="login.inc.php" method="post">
                            <button id='signup-button' type="submit" name="signup-submit">Sign Up</button>
                        </form>
                    </div>

                </div>

            </form>

        </div>

    </div>

    <footer>
        <pre>Callum-James Smith© All rights reserved</pre>
    </footer>

</body>

</html>