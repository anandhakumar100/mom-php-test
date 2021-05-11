<?php

namespace Magento;

require '../vendor/autoload.php';
require 'email_config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    public function send($content) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
            $mail->SMTPDebug = 0;                                       //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                             //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                     //Enable SMTP authentication
            $mail->Username = EMAIL;                                    //SMTP username
            $mail->Password = PASSWORD;                                 //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                          //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom(EMAIL, 'Admin');
            $mail->addAddress('anandhakumar100@gmail.com');             //Add a recipient
            $mail->addReplyTo(EMAIL);
        
            //Content
            $body = 'Hello,<br>Please find the report details below:<br> ' . $content;
            $mail->isHTML(true);       
            $mail->Subject = 'RE: Report received';
            $mail->Body = $body;                                        //Set email format to HTML
            
            $mail->send();

            return true;

        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }

        return false;
    }
}