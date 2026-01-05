<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var($_POST['form_name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['form_email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['form_subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['form_message'], FILTER_SANITIZE_STRING);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email address']);
        exit;
    }
    
    $to = "cloudcomputingskill.lab@gmail.com";
    $email_subject = "Contact Form: " . $subject;
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n\n";
    $email_body .= "Message:\n$message";
    
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo json_encode(['status' => 'success', 'message' => 'Thank you! Your message has been sent successfully. We will respond within 24 hours.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error sending your message. Please try again.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>