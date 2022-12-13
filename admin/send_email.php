<?php

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    //Globally
    $from = 'no-reply@gmail.com';

    // A plain text email for Access Login
    $loginID = '1234567890';
    $to = 'jamilusalis@gmail.com';
    $subject = 'Scheduling Portal Login ID';

    $message = 
    'Hello, please find below your login ID to the Scheduling Portal.
        
        Login ID: '.$loginID;
    
    // Sending email
    if(mail($to, $subject, $message)) {
        echo 'Your login ID mail has been sent successfully. <br/>';
    } else {
        echo 'Unable to send email. Please try again.';
    }


    // A plain text email for Scheduling Assigment
    $title = 'titleHere...';
    $location = 'Location, State, LGA';
    $when = 'Date';
    $timing = 'TimeStart - TimeEnd';
    $contact_person = 'ContactPerson';

    $to = 'jamilusalis@gmail.com';
    $subject = 'New Scheduled Assignment';

    $message = 
    'Hello, you are assigned to facilitate training as follows:

        Programme Title: '.$title.'
        Traning Location: '.$location.'
        Date: '.$when.' by '.$timing .'
        Contact person: '.$contact_person.'

   Please ensure you get in touch with the contact person above for further information.
   Kind regards.'; 
    
    // Sending email
    if(mail($to, $subject, $message)) {
        echo 'Assignment been assiged successfully.';
    } else {
        echo 'Unable to assign email. Please try again.';
    }

?>