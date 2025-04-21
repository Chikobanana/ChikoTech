<?php
// Define configuration variables
$recipientEmail = "chikotech@gmail.com";  // The email address where form submissions will be sent
$websiteName = "ChikoTech";               // Your website name for the email subject

// Initialize response array
$response = array(
    'status' => 'error',
    'message' => 'An unknown error occurred'
);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = filter_var($_POST['name'] ?? '', FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'] ?? 'Website Contact Form', FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'] ?? '', FILTER_SANITIZE_STRING);
    
    // Validate data
    if (empty($name) || empty($email) || empty($message)) {
        $response['message'] = 'Please fill in all required fields';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Please enter a valid email address';
    } else {
        // Prepare email
        $emailSubject = "$websiteName: $subject";
        $emailBody = "You have received a new message from your website contact form.\n\n";
        $emailBody .= "Name: $name\n";
        $emailBody .= "Email: $email\n";
        $emailBody .= "Subject: $subject\n\n";
        $emailBody .= "Message:\n$message\n";
        
        // Headers
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Send email
        if (mail($recipientEmail, $emailSubject, $emailBody, $headers)) {
            $response = array(
                'status' => 'success',
                'message' => 'Your message has been sent. Thank you!'
            );
        } else {
            $response['message'] = 'Sorry, there was an error sending your message. Please try again later.';
        }
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>