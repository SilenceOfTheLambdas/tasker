<?php
/**
 * db.php
 * This script is used to connect to the database
 * Created by: Callum-James Smith (cs18804)
 */

// Setup the connection to the MySQL database and table
$connection = mysqli_connect('localhost', 'root', '', 'tasker') or die(mysqli_error($connection));

