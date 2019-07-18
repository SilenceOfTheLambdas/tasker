<!-- 
    This is the signup page.
 -->
<!DOCTYPE html>

<head>

    <!-- Meta stuffs -->
    <meta type='description' content='A task management website.'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link rel='stylesheet' href="css/signup.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <title>Task Manager</title>

</head>

<body>

    <form id="SignupForm" action="signup.inc.php" method="post">
        <h1>Sign Up</h1>
        <?php
        include 'functions.inc.php';
        SignUpForm();
        ?>
        <input type="password" name="password" placeholder="Password..."><br>
        <input type="Password" name="password-repeat" placeholder="Re-enter password..."><br>

        <button class='signup-button' type="submit" name="signup-submit">Sign Up</button><br>
        <p><a href="index.php"><i class="fas fa-reply"></i> return</a></p>
    </form>

</body>

</html> 