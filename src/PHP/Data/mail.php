<?php

require 'inc/PHPMailer/src/PHPMailer.php';
require 'inc/PHPMailer/src/SMTP.php';
require 'inc/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// hieronder een functie waarmee je een mail kan sturen...
function Mailen($email, $naam, $onderwerp, $bericht) {
    // Stuur een e-mail ter bevestiging
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPAutoTLS = false;
    // $mail->SMTPSecure = "ssl";
    $mail->Host = "mail.47854.hbcdeveloper.nl";

    // Identificeer jezelf bij Gmail
    $mail->Username = "h47854";
    $mail->Password = "RwpsI6H4TUNNUjG";

    // email opstellen
    $mail->isHTML(true);
    $mail->setFrom("h47854@47854.hbcdeveloper.nl", "Julian van Stavel");
    $mail->Subject = $onderwerp;
    $mail->CharSet = 'UTF-8';
    $bericht = "<body style=\"font-family: Verdana, Geneva, sans-serif;
    font-size: 14px; color: #000;\">" . $bericht . "</body>";
    foreach ($email as $address) {
        $mail->addAddress($address, $naam);
    }
    $mail->Body = $bericht;
    // stuur de mail...
    if ($mail->Send()) {
        echo "<script>alert('Mail is verstuurd!')</script>" . PHP_EOL;
    } else {
        echo "Mail error: " . $mail->ErrorInfo . PHP_EOL;
        echo "<script>alert('Mail kon niet verstuurd worden!')</script>" . PHP_EOL;
    }
}
?>