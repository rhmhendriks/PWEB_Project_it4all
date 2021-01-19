<?php

function sendMail($subject, $reciever, $body, $debug){

    // SMTP server configuration
    $smtp_server = 'mail.rhmhendriks.nl';
    $username = 'rhmhendriks@rhmhendriks.nl';
    $password = 'R0n@ld1999-1705';
    $port = '25'; 

    $html_content = file_get_contents($body);

    // create message
    $message = Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom(['rhmhendriks@rhmhendriks.nl'])
        ->setTo([$reciever])
        ->setBody($body, 'text/html');

    // create transport
    $transport = Swift_SmtpTransport::newInstance($smtp_server, $port, $encryption)
        ->setUsername($username)
        ->setPassword($password);

    // pass transport to the swift mailer
    $mailer = Swift_Mailer::newInstance($transport);

    // send email
    $result = $mailer->send($message);

    if ($result) {
        $debug .= "Message has been successfully sent!";
    }
}

?>