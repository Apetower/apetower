<?php
    // My modifications to mailer script from:
    // http://blog.teamtreehouse.com/create-ajax-contact-form
    // Added input sanitizing to prevent injection

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $email = filter_var(trim($_REQUEST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_REQUEST["message"]);

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){	
                    http_response_code(400);
                    echo 'Please check the email address you entered.';
                    exit();	
}
        // Check that data was sent to the mailer.
        if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Something was wrong with that...";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "joe@apetower.com";

        // Set the email subject.
        $subject = "Web Inquiry from $email";

        $email_content .= "Email: $email\n\n";
        
        // Build the email headers.
        $email_headers = "From: $email <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You!";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>