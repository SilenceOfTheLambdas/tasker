<?php
/**
 * signout.inc.php 
 * Used to sign the user out and stop the session
 * Created by: Callum-James Smith(cs18804)
 */

if (isset($_POST['signout'])) // if the user selects the sign out button
    {
        session_start(); // You must have session_start() whenever adjusting the values for $_SESSION

        session_destroy(); // destroy the session 
        session_unset(); // unset any variables associated with the session
        unset($_SESSION['name']); // do this for both vars
        unset($_SESSION['id']);
        $_SESSION = array(); // set $_SESSION equal to an empty array

        header("location: index.php?logout=successful"); // then take them back to the login page
        exit();
    }
