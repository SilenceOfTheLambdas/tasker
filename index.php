<!-- 
    Tasker.io
    A task management system
    This is the login page.
    Created by: Callum-James Smith (cs18804)
 -->

<!-- PHP Includes -->
<?php
    include('signupPHP.php');
?>

<!DOCTYPE html>
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
        <form id="LoginForm" action="" method="post">
            <h1 id="Sign In">Sign In</h1>
            Email<input type="email" name="email" id="email" placeholder="Email..."><br/>
            Password<input type="password" name="password" id="password" placeholder="Password..."><br>
            <input name="action" type="hidden" value="login">
            <input type="submit" value="Login">
            <a class="button" href="signup.php">Sign Up</a>
        </form>
    </div>

</body>

</html>