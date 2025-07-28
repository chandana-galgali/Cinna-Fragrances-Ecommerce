<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendWelcomeEmail($email, $name) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'chandana.g@somaiya.edu';  // Your email
        $mail->Password   = 'asubkwnxrxjjmiex';         // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender and recipient settings
        $mail->setFrom('chandana.g@somaiya.edu', 'Cinna Fragrances');
        $mail->addAddress($email, $name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Exclusive Offer Just for You at Cinna Fragrances!';
        
        // Personalized HTML Body
        $mail->Body = '
            <html>
            <body style="font-family: Arial, sans-serif; background-color: #ffffff; color: #333333; margin: 0; padding: 20px;">
                <div style="max-width: 600px; margin: auto; background-color: #0b1d3b; padding: 20px; border: 1px solid #b39555; border-radius: 8px;">
                    <h2 style="color: #b39555; text-align: center; border-bottom: 2px solid #b39555; padding-bottom: 10px;">
                        Welcome to <span style="color: #ffffff;">Cinna Fragrances</span>, <br>Your Fragrance Destination!
                    </h2>
                    <p style="font-size: 1.1em; color: #ffffff;">Dear <strong>' . htmlspecialchars($name) . '</strong>,</p>
                    <p style="font-size: 1em; color: #ffffff;">
                        We are thrilled to have you as part of the Cinna Fragrances family! To show our appreciation, we are offering an
                        exclusive <strong style="color: #b39555;">15% discount</strong> on your next purchase. Indulge in the luxury of our latest arrivals
                        and signature scents.
                    </p>
                    <h3 style="color: #0b1d3b; text-align: center; margin-top: 20px; padding: 10px; background-color: #b39555; border-radius: 8px;">
                        Exclusive Offer Code: <span style="color: #0b1d3b;">CHANDANA20</span>
                    </h3>
                    <p style="font-size: 1em; color: #ffffff; text-align: center;">
                        Use this code at checkout to redeem your discount. Dont wait too long - this offer is valid only for the next 7 days!
                    </p>
                    <hr style="border: none; border-top: 2px solid #b39555; margin: 20px 0;">
                    <p style="color: #ffffff;">Thank you for choosing Cinna Fragrances. We look forward to bringing you more enchanting scents!</p>
                    <p style="color: #ffffff;">
                        Sincerely,<br><span style="font-weight: bold; color: #b39555;">Cinna Fragrances Team</span>
                    </p>
                </div>
            </body>
            </html>';

        // Plain text alternative
        $mail->AltBody = 'Thank you for being a valued customer at Cinna Fragrances! Enjoy 15% off your next purchase with the code CHANDANA20. Visit us at https://keva.co.in/ to explore our exclusive fragrances.';

        // Send the email
        $mail->send();
        echo 'Promotional email has been sent successfully to ' . htmlspecialchars($name);
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>