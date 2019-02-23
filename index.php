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
            <img src="img/tasker-logo.png">
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
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis quo ducimus animi, nisi eaque vitae ipsa deserunt placeat accusantium aperiam, expedita nemo a debitis dolor delectus ea adipisci earum sed!
        Expedita natus ipsa reprehenderit magni amet enim error sit alias quisquam maxime autem in consectetur ex, blanditiis accusantium officia optio esse, at odio culpa aliquid. Suscipit necessitatibus ipsum eaque ducimus!
        Quam quae hic ipsum aspernatur porro incidunt itaque vitae laborum, quisquam veritatis commodi ipsa, accusamus praesentium nesciunt, qui voluptates a eligendi dolorum asperiores dolore in facilis laudantium voluptatum! Dicta, commodi.
        Eveniet consequatur at, culpa odit ex odio! Eligendi atque iure, ipsum dicta ratione explicabo exercitationem dolorum cum voluptate dignissimos quae, molestiae ullam unde aspernatur quam mollitia modi laboriosam molestias repudiandae?
        Esse quo officia, velit suscipit iure alias et iusto sunt cumque corrupti porro quaerat recusandae a pariatur qui explicabo nihil accusamus vero harum dolorem. Sequi qui ad dolores officia eum!
        Quis tempora accusantium sapiente ut sint aspernatur pariatur laudantium nihil laborum voluptatum expedita maxime error aut, vero amet ipsam incidunt ab tempore repellendus. Commodi deleniti nostrum facilis non tempora expedita.
        Quibusdam laudantium porro non ducimus itaque officia eveniet aut totam hic? Labore vitae eos ab fugiat doloribus nulla quam error, quaerat expedita. Est numquam odio, consequatur voluptas nam quasi nihil.
        Necessitatibus labore, corrupti numquam sapiente eos culpa ipsam consequatur vel natus aliquid aspernatur consequuntur adipisci est placeat voluptatibus minus. Fuga numquam facere quae nulla quaerat, rerum quis molestias quam odio.
        Debitis corporis doloremque repellendus perspiciatis facilis. A, delectus dolor ad ipsa, veritatis nemo optio perspiciatis laboriosam enim beatae iste dolorum sit deleniti incidunt veniam voluptatem ullam itaque? Vel, totam eveniet.
        Eum nulla aliquid architecto recusandae nesciunt laboriosam magni, tempore totam voluptate odio magnam fugit ab molestias, rem accusamus animi vero exercitationem? Id exercitationem minima eligendi alias quidem ipsum, sit accusamus.
        Aliquam nesciunt ab iusto quidem vitae quos sed aliquid, est distinctio veritatis corrupti nobis adipisci animi deleniti tempore quia nulla culpa fugit magnam cupiditate nihil praesentium optio? Perferendis, iusto officiis.
        Sit, saepe? Distinctio sint quisquam asperiores neque fugiat doloremque pariatur cum possimus dolores quos. Voluptatem, reprehenderit eos porro ullam voluptas ducimus suscipit et tenetur commodi quae necessitatibus, nemo at distinctio?
        Nostrum odio explicabo autem, temporibus ex molestias tempora dolor expedita minima eum asperiores quos porro eveniet ea soluta alias, nulla sed rem! Itaque quae libero nisi fuga cum, veniam ab.
        Veritatis hic inventore sapiente harum ex? Nihil libero distinctio reprehenderit iure ut alias voluptate optio commodi, quo accusamus, neque voluptatem doloremque hic atque sit dolorem pariatur. Illo accusamus labore nulla.
        Incidunt, saepe! Aspernatur nobis quidem autem hic sint perferendis labore minus, voluptatem ex facere nostrum sequi, adipisci ea, ipsa maiores illo animi soluta officiis quos repellendus perspiciatis earum! Vel, praesentium!
        Veniam mollitia, officiis excepturi quibusdam officia perspiciatis ex, laboriosam iusto necessitatibus consequuntur tenetur aperiam reiciendis iste vero cumque similique sit iure sed ab magni corrupti delectus. Quo tempore quibusdam corrupti?
        Repellat, nesciunt temporibus sed commodi at laboriosam perspiciatis optio doloremque voluptatibus exercitationem cupiditate non iste officiis fugiat hic mollitia rerum omnis, est earum consectetur ipsam dolores explicabo natus vero? Assumenda.
        Maxime, neque? Sed est distinctio dolor veniam, ipsam quibusdam in aperiam ex explicabo obcaecati, dolores magnam! Vel placeat mollitia deserunt incidunt, molestias tempore? Voluptatem enim earum inventore molestiae, libero nesciunt.
        Exercitationem quaerat nemo assumenda omnis voluptatum facere optio corrupti aliquam dolores ipsum reprehenderit, quis ipsam sit natus asperiores maiores nesciunt ducimus cumque minima, consequatur itaque debitis atque, nostrum hic! Similique.
        Repellendus veniam mollitia ipsa facilis assumenda nemo consequuntur dolorem sed quibusdam perspiciatis temporibus inventore cum nesciunt commodi quaerat animi officia, adipisci eos perferendis totam quo. Natus accusantium necessitatibus aut soluta?
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