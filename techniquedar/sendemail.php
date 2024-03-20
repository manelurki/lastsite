<?php
// Define some constants
define("RECIPIENT_NAME", "technique dar");
define("RECIPIENT_EMAIL", "menelturki@gmail.com");

// Read the form values
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = isset($_POST['username']) ? trim($_POST['username']) : "";
    $senderEmail = isset($_POST['email']) ? trim($_POST['email']) : "";
    $userPhone = isset($_POST['phone']) ? trim($_POST['phone']) : "";
    $message = isset($_POST['message']) ? trim($_POST['message']) : "";

    // Validate form fields
    if (!empty($userName) && !empty($senderEmail) && !empty($userPhone) && !empty($message)) {
        // Prepare email
        $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
        $subject = "New Message from Contact Form";
        $msgBody = "Name: $userName\nEmail: $senderEmail\nPhone: $userPhone\nMessage: $message";
        $headers = "From: $userName <$senderEmail>";

        // Send email
        $success = mail($recipient, $subject, $msgBody, $headers);
        
        if ($success) {
            // Redirect after successful submission
            header('Location: contact.html?message=Successfull');
            exit; // Stop further execution
        } else {
            // Redirect after unsuccessful submission
            header('Location: contact.html?message=Failed');
            exit; // Stop further execution
        }
    } else {
        // Redirect if required fields are not filled
        header('Location: contact.html?message=Incomplete');
        exit; // Stop further execution
    }
}
?>
