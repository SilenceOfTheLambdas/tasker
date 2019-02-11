<!-- 
    Tasker.io
    A task management system
    This is the login page.
    Created by: Callum-James Smith (cs18804)
 -->
<!DOCTYPE html>
<!-- PHP Includes -->
<?php

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

    <div class="loginBox">
        <form id="LoginForm" action="login.php" method="post">
            <h1 id="Sign In">Sign In</h1>
            <input type="email" name="email" id="email" placeholder="Email..."><br/>
            <input type="password" name="password" id="password" placeholder="Password..."><br>
            <button type="submit" name="signin-submit">Sign In</button>
            <button type="submit" name="signup-submit">Sign Up</button>
        </form>
    </div>

</body>

</html>