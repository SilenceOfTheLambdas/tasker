<?php

if (isset($_POST['add-title'])) {
    session_start();

    $title = $_POST['title'];
    $titleString = "<div class='item'>".$title."</div>";
    $_SESSION['newItem'] = $titleString;
    $_SESSION['item-added'] = true;
    header("Location: landing.php?item-added");

}

