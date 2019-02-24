<!-- 
    Tasker.io
    A task management system
    This is the login page.
    Created by: Callum-James Smith (cs18804)
    files indicated with *.inc.php are used to process the information
 -->
<!DOCTYPE html>
<!-- PHP Includes -->
<?php
    session_start();
    if (isset($_SESSION['name']) && isset($_SESSION['id'])) // If the user already has a session, 'log them in'
    {
        header("Location: landing.php");
    }
?>
<head>

    <!-- Meta stuffs -->
    <meta type='description' content='A task management website.'>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSS -->
    <link rel='stylesheet' href="css/index.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <title>Task Manager</title>
    
</head>

<body>

    <header id="index-header">

        <div id="top-logo">
            <img src="img/Tasker.io_Transparent.png">
        </div>

        <div id="buttons">
            <a href="#sign-in-modal" id="open-signin-modal"><button id='signin-button' type="submit" name="signin-submit">SIGN IN</button></a><br/>

            <a href="signup.php"><button id='open-signup-modal' type="submit" name="signup-submit">SIGN UP</button></a>
        </div>

        <div id="sign-in-modal" style="display: none;" class="modalDialog">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h1>SIGN IN</h1>
                    <form id="LoginForm" action="login.inc.php" method="post">
                        <?php 
                            include 'functions.inc.php';
                            LoginForm();
                        ?>
                    <button id='signin-button' type="submit" name="signin-submit">Sign In</button>
                </form>
            </div>
        </div>

    </header>

    <div id="info-box">
        <h2>INFO</h2>
        <hr>
        <p>A free, no bullshit task management system.</p><br/>
        oh, and it's open source.
    </div>

    <main id="info">

    </main>

</body>
    <script>
        document.getElementById("open-signin-modal").onclick = function() // Stop the modal boxes from appearing quickly every time the page is refreshed
        {
            var modal = document.getElementById("sign-in-modal");
            modal.style.display = 'block';
        }
    </script>
</html>