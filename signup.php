<!-- 
    Tasker.io
    A task management system
    This is the signup page.
    Created by: Callum-James Smith (cs18804)
 -->
 <!DOCTYPE html>
<?php
    include('signup.inc.php');
?>
<head>
     
    <!-- Meta stuffs -->
    <meta type='description' content='A task management website.'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
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

    <div class="signupWrapper">
    
        <div class="signupBox">

            <form id="LoginForm" action="signup.inc.php" method="post">

                <h1 id="Sign In">Sign In</h1>
                <input type="text" style="margin-bottom: 20px;" name="name" placeholder="Name..."><br>
                <input type="email" style="margin-bottom: 20px;" name="email" placeholder="Email..."><br>
                <input type="password" style="margin-bottom: 20px;" name="password" placeholder="Password..."><br>
                <input type="Password" name="password-repeat" placeholder="Re-enter password..."><br>

                <div class="formButtons">

                    <div class="signup">
                        <form id="LoginForm" action="signup.inc.php" method="post">
                            <button id='signup-button-1' type="submit" name="signup-submit">Sign Up</button>
                        </form>
                    </div>

                </div>

            </form>

        </div>

    </div>

</body>

</html>