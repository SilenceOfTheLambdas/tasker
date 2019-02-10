<!-- Connect to the database -->
<?php

// Setup the connection to the MySQL database and table
$connection = mysqli_connect('localhost', 'root', '', 'tasker') or die(mysqli_error($connection));