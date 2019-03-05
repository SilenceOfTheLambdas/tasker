<!-- 
    User's account information will be display here. Allowing the user to edit details of they wish.
    Created by: Callum-James Smith (cs18804)
 -->
 <?php
 session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/account.css">
    <title>Account | Takerio</title>
</head>
<body>
    <main id="flex-container">

        <div id="left-pane">
            <div id="image-holder">
                <img src="img/Logo.png" alt="User Logo">
            </div>
            <div id="spacer"></div>
            <div id="delete">
                <form action="delete-account.php" method="post">
                    <button type="submit">Delete Account</button>
                </form>
            </div>
        </div>

        <div id="top-pane">
            <h1>Hello, <?php 
                        echo($_SESSION['name']);
                        ?>
            </h1>
        </div>

        <div id="bottom-pane">
            <div id="user-details">
                <?php
                    include_once "functions.inc.php";
                    echo(accountDetails("name"));
                    echo(accountDetails("email"));
                ?>
                <h3>$password</h3>
            </div>
        </div>

    </main>
</body>
</html>