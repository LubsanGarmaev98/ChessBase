<?php

namespace App\Service\Consumers;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class EmailConsumer
{
    public static function sendToEmail(string $email): ?string
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = "lubsan14091998@gmail.com";             //SMTP username
            $mail->Password   = "vvecpkpgcktxifsh";                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            //Recipients
            $mail->setFrom('lubsan14091998@gmail.com', 'Lubsan');
            $mail->addAddress($email, 'Rabbit');     //Add a recipient

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Регистрация в сервисе ChessBase';
            $mail->Body = 'Привет дорогой пользователь, очень рады что вы зарегистрировались на нашем сервисе. Приятного пользования!';

            $mail->send();
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return null;
    }
}