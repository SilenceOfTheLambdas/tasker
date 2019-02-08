<!-- Connect to the database -->
<?php
    $connection = mysqli_connect('localhost', 'root', '', 'tasker') or die(mysqli_error($connection));
?>