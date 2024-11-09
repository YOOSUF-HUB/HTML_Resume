<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $user_name = htmlspecialchars($_POST['user_name']);
    $user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    
    // Check if email is valid
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Email details
    $to = "yahamed95@gmail.com";  // Recipient's email address
    $subject = "New Message from Contact Form";
    $headers = "From: " . $user_email . "\r\n";
    $headers .= "Reply-To: " . $user_email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    // Prepare email body
    $email_body = "<html><body>";
    $email_body .= "<h2>New Message from Contact Form</h2>";
    $email_body .= "<p><strong>Name:</strong> $user_name</p>";
    $email_body .= "<p><strong>Email:</strong> $user_email</p>";
    $email_body .= "<p><strong>Message:</strong><br>$message</p>";
    $email_body .= "</body></html>";

    // Send email
    if (mail($to, $subject, $email_body, $headers)) {
        echo "Your message has been sent successfully!";
    } else {
        echo "Failed to send message. Please try again later.";
    }
}
?>
