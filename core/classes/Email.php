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
            $mail->Subject = APP_NAME . ' - Confirmação de E-mail';
            $html = '<p>Bem vindo a nossa loja ' . APP_NAME . '.</p>';
            $html .= '<p>Para entrar na loja, você deve confirmar o e-mail.</p>';
            $html .= '<p>Clique abaixo para confirmar sua conta:</p>';
            $html .= "<p><a href='$purl'>Confirmar a conta</a></p>";
            $html .= '<p><i><small>' . APP_NAME . '</small></i></p>';
            $mail->Body = $html;
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}