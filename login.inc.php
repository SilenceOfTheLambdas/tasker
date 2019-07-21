<?php
session_start();
?>
<?php
 /*
 * login.inc.php
 * handles the login request from the user.
 * Created by: Callum-James Smith(cs18804)
*/

if (isset($_POST['signin-submit'])) {
    require 'db.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email))
        // Checks to see if any of the fields are empty
        {
            header("Location: index.php?emptyemail");
            // ^ throws an error and re-applies the data back into the fields if available
            exit(); // Stop script from running
        } else if (empty($password)) {
        header("Location: index.php?error=emptypassword&email=" . $email);
        exit();
    } else // If fields are NOT empty
        {
            $EmailQuery = "SELECT email FROM users WHERE email='" . $email . "'"; // The query string
            $DBEmail = mysqli_query($connection, $EmailQuery); // The actual query
            $DBEmailRows = mysqli_num_rows($DBEmail); // Obtains the number of rows from the query

            if ($DBEmailRows >= 1) // If a row exists the the username is correct
                {

                    $PasswordQuery = "SELECT * FROM users WHERE email='" . $email . "'";
                    $DBPasswordSQL = mysqli_query($connection, $PasswordQuery);
                    $row = mysqli_fetch_assoc($DBPasswordSQL);
                    $PasswordCheck = password_verify($password, $row['password']);
                    
                    $verify = "SELECT verfied FROM users WHERE email='" . $email . "'";
                    $query = mysqli_query($connection, $verify);
                    $verifyRow = mysqli_fetch_assoc($query);
                    $Verified = $verifyRow['verfied'];

                    if ($Verified == 0) {
                        header("Location: index.php?error=accountnotactivated");
                        exit();
                    }

                    if ($PasswordCheck == true) // If so then check to see of the password for that user matches
                        {
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['name'] = $row['name'];
                            $_SESSION['email'] = $row['email'];

                            $ProjectID = "SELECT * FROM projects,users WHERE user_id=" . $_SESSION['id'] . " AND projectID=users.last_project";
                            $projectID_result = $connection->query($ProjectID);
                            $projectID_row = $projectID_result->fetch_assoc();
                            if ($projectID_row['last_project'] == null) {
                                include_once 'functions.inc.php';
                                $ID = ProjectID();
                            } else {
                                $ID = intval($projectID_row['last_project']);
                            }
                            $_SESSION['projects'] = $ID;

                            include_once "functions.inc.php";
                            $Project = LastSelectedProject();

                            header("Location: landing.php?signin=success&projects=$ID");
                            exit();
                        } elseif ($PasswordCheck == false) {
                        header("Location: index.php?error=invalidpassword&email=" . $email);
                        exit();
                    }
                } else {
                header("Location: index.php?error=invalidemail");
                exit();
            }
        }
}
