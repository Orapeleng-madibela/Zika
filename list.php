<?php
$organizerEmail = 'madibelaorapeleng17@gmail.com';
$subject = 'RSVP List for Birthday Party';
$headers = 'From: noreply@example.com' . "\r\n" .
           'Reply-To: noreply@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

$message = "RSVP List:\n\n";

// Read RSVPs from file
if (file_exists('rsvps.csv')) {
    $file = fopen('rsvps.csv', 'r');
    
    while (($data = fgetcsv($file)) !== FALSE) {
        $message .= "Name: $data[0], Phone: $data[1], Email: $data[2]\n";
    }
    
    fclose($file);

    // Send email
    mail($organizerEmail, $subject, $message, $headers);
} else {
    echo 'No RSVPs found.';
}
?>
