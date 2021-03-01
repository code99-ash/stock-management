<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

function sendMail($recipient, $body)
{
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername($_ENV['EMAIL'])
        ->setPassword($_ENV['PW']);

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message('Verify your Account'))
        ->setFrom([$_ENV['APP_MAIL'] => $_ENV['APP_NAME']])
        ->setTo([$recipient])
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);
    if ($result) {
        return true;
    }
}

?>
