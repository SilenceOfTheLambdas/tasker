<?php

function send_mail ($email, $name) {
    // Create a new activation hash
    $hash = md5( rand(0,1000));

    // The message being sent to the user
    $to      = $email; // Send email to our user
    $subject = 'Tasker.io | Email Change'; // Give the email a subject
    $message = '
    
    Please visit the link below to activate your new email address.
    
    ------------------------
    Username: '.$name.'
    ------------------------
    
    Please click this link to activate your account:
    https://www.techanddragons.co.uk/TEMP/change-account.php?email='.$email.'&hash='.$hash.'
    
    '; // Our message above including the link
                        
    $headers = 'From:admin@techanddragons.co.uk' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email
}