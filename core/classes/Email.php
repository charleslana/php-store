<?php

namespace core\classes;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{

    public function sendEmailNewAccount(string $email, string $name, string $purl): bool
    {
        $purl = BASE_URL . '?action=confirm_email&purl=' . $purl;
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = EMAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL_FROM;
            $mail->Password = EMAIL_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = APP_NAME . ' - Email confirmation';
            $html = '<p>Welcome to our store' . APP_NAME . '.</p>';
            $html .= '<p>To enter our store, you need to confirm your email.</p>';
            $html .= '<p>To confirm the email click on the link below:</p>';
            $html .= "<p><a href='$purl'>Email confirmation</a></p>";
            $html .= '<p><i><small>' . APP_NAME . '</small></i></p>';
            $mail->Body = $html;
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}