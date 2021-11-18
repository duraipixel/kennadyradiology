
<?php
// Multiple recipients
$to = 'kalaivani.pixel@gmail.com'; // note the comma

// Subject
$subject = 'Birthday Reminders for August';

// Message
$message = 'test mail from john web server';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: Mary <>';
$headers[] = 'From:  <>';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));
?>
