<?php
/**
 * db.php
 * This script is used to connect to the database
 * Created by: Callum-James Smith (cs18804)
 */

// Setup the connection to the MySQL database and table
$connection = mysqli_connect('cseemyweb.essex.ac.uk:3306', 'cs18804', 'fR3psESWKTDs7', 'ce154_cs18804') or die(mysqli_error($connection));