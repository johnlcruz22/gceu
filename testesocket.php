<?php
$to       = 'devieiracruz@gmail.com';
$subject  = 'Testing sendmail.exe';
$message  = 'Hi, you just received an email using sendmail!';
$headers  = 'From: john.lcruz22@gmail.com' . "\r\n" .
            'Reply-To: seuemail@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
var_dump(phpversion());
if(mail($to, $subject, $message, $headers) > 0)
    echo "Email sent";
else
    echo "Email sending failed";
?>




