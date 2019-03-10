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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Account | Takerio</title>
</head>

<body>
    <main id="flex-container">

        <div id="left-pane">
            <div id="image-holder">
                <img src="img/adminLogo.png" alt="User Logo">
            </div>
            <div id="spacer"></div>
            <div id="delete">
                <a href="#DeleteModal" id="open-modal"><button id="delete-account">Delete Account</button></a> <!-- button to activate modal -->
                <?php
                echo ('<form action="account.php" method="get">
                            <input type="hidden" name="return-home">
                            <a id="open-modal"><button id="delete-account">Return</button></a> <!-- button to activate modal -->
                        </form>');
                if (isset($_GET['return-home'])) {
                    include_once 'functions.inc.php';
                    returnToLanding();
                }
                ?>
            </div>
        </div>

        <div id="top-pane">
            <h1>Hello, <?php 
                        echo ($_SESSION['name']);
                        ?>
            </h1>
        </div>

        <div id="bottom-pane">
            <div id="user-details">
                <?php
                include_once "functions.inc.php";
                echo (accountDetails("name"));
                echo (accountDetails("email"));
                ?>
                <h3>$password</h3>
            </div>
        </div>

        <div id="DeleteModal" class="modalDialog" style="display: none;">
            <!-- The modal box that holds everything -->
            <div>
                <!-- the element inside -->
                <a href="#close" title="Close" class="close">X</a> <!-- The close button -->
                <h1>Are You Sure?</h1>
                <form action="delete-account.php" method="get">
                    <!-- <input type="text" style="display: none;" name="account-del"> -->
                    <button type="submit" name="account-del">Yes</button>
                </form>
                <a href="#close" title="Close"><button>No</button></a>
            </div>
        </div>

    </main>
</body>
<script>
    document.getElementById("open-modal").onclick = function() // Stop the modal boxes from appearing quickly every time the page is refreshed
    {
        var modal = document.getElementById("DeleteModal");
        modal.style.display = 'block';
    }
</script>

</html> 