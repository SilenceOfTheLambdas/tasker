<?php
session_start();
?>
<!-- 
    Tasker.io
    A task management system
    This is the login page.
    Created by: Callum-James Smith (cs18804)
    files indicated with *.inc.php are used to process the information and is NOT seen by the user.
 -->
<!DOCTYPE html>
<!-- PHP Includes -->
<?php
if (isset($_SESSION['name']) && isset($_SESSION['id'])) // If the user already has a session, 'log them in'
    {
        include_once 'functions.inc.php';
        $projectID = LastSelectedProject();
        header("Location: landing.php?projects=$projectID");
        exit();
    }

if (isset($_GET['verify'])) {
    echo '<div><p style="color:black">Please verify your account! (Check your email)<p></div>';
} if (isset($_GET['error'])) {
    if ($_GET['error'] == "accountnotactivated") {
        echo '<div><p style="color:black">Account not activated yet!<p></div>';
    }
}

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    require 'db.php';
    // Verify data
    $email = $_GET['email']; // Set email variable
    $hash = $_GET['hash']; // Set hash variable

    $search = mysqli_query($connection,"SELECT email, hash, verfied FROM users WHERE email='".$email."' AND hash='".$hash."' AND verfied='0'") or die(mysqli_error($connection));
    $match  = mysqli_num_rows($search);

    if ($match) {
        mysqli_query($connection,"UPDATE users SET verfied='1' WHERE email='".$email."' AND hash='".$hash."' AND verfied='0'") or die(mysqli_error($connection));
        echo '<div>Your account has been activated, you can now login</div>';
    }

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
            <img src="images/Tasker.io_Transparent.png">
        </div>

        <div id="buttons">
            <a href="#sign-in-modal" id="open-signin-modal"><button id='signin-button' type="submit" name="signin-submit">SIGN IN</button></a><br />

            <a href="signup.php"><button id='open-signup-modal' type="submit" name="signup-submit">SIGN UP</button></a>
        </div>

        <div id="sign-in-modal" style="display: none;" class="modalDialog">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h1>SIGN IN</h1>
                <form id="LoginForm" action="login.inc.php" method="post">
                    <?php 
                    include("functions.inc.php");
                    LoginForm();
                    ?>
                    <button id='signin-button' type="submit" name="signin-submit">Sign In</button>
                </form>
            </div>
        </div>
    </header>

<footer>
    <p>Callum-James Smith | <a href="mailto:csmith99@protonmail.com">csmith99@protonmail.com</a></p>
</footer>
<script>
    document.getElementById("open-signin-modal").onclick = function() // Stop the modal boxes from appearing quickly every time the page is refreshed
    {
        var modal = document.getElementById("sign-in-modal");
        modal.style.display = 'block';
    }
</script>

</html> 