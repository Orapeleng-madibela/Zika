<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';

    // Email details
    $to = 'madibelaorapeleng17@gmail.com';
    $subject = 'New RSVP for the Birthday Party';
    $message = "Name: $name\nPhone: $phone\nEmail: $email";
    $headers = 'From: noreply@example.com' . "\r\n" .
               'Reply-To: noreply@example.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Save RSVP to file
    $file = fopen('rsvps.csv', 'a');
    fputcsv($file, [$name, $phone, $email]);
    fclose($file);

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo 'Thank you for your RSVP!';
    } else {
        echo 'There was a problem with your RSVP. Please try again.';
    }
} else {
    echo 'Invalid request method.';
}
?>
