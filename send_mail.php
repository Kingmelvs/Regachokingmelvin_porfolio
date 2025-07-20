<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'regachokingmelvin@gmail.com';
        $mail->Password = 'yhrph vlja mbdn zqry'; // App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Input values
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $message = nl2br(htmlspecialchars($_POST['message']));

        // Email settings
        $mail->setFrom('regachokingmelvin@gmail.com', $name);
        $mail->addReplyTo($email, $name);
        $mail->addAddress('regachokingmelvin@gmail.com', 'Your Name');

        $mail->isHTML(true);
        $mail->Subject = 'New Message from Website';
        $mail->Body = "
            <strong>Name:</strong> $name<br>
            <strong>Email:</strong> $email<br>
            <strong>Phone:</strong> $phone<br>
            <strong>Message:</strong><br>$message
        ";

        $mail->send();
        echo 'success';
    } catch (Exception $e) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>
