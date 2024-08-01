<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($subject);
    $message = htmlspecialchars($message);

   
    require 'vendor/autoload.php';

    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername('Enter your email address') //provide appropriate credentials
        ->setPassword('Enter your password');//provide appropriate credentials

    $mailer = new Swift_Mailer($transport);

    $mailMessage = (new Swift_Message($subject))
        ->setFrom(['Enter your email address' => 'YourName'])//provide appropriate credentials
        ->setTo([$email])
        ->setBody($message);
       
    try {
        $result = $mailer->send($mailMessage);
        if ($result) {
            echo "Mail sent successfully";

          
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("INSERT INTO sent_mails (email, subject, message, sent_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $email, $subject, $message);

            if ($stmt->execute()) {
                echo "Mail saved to database.";
            } else {
                echo "Error saving mail: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "Failed to send mail.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
