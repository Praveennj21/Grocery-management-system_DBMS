<?php
// Include database connection
include('db.php');

// Fetch products with remaining quantity less than 20
$sql = "SELECT p.id, p.name, p.remaining, u.email
        FROM products p
        INNER JOIN user u ON p.id = u.id
        WHERE p.remaining < 20";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each product with low quantity
    while ($row = $result->fetch_assoc()) {
        // Compose email message
        $to = $row['email'];
        $subject = 'Low Quantity Alert';
        $message = 'Dear User, <br><br>';
        $message .= 'The remaining quantity for the product "' . $row['name'] . '" is less than 20. Please take necessary action.<br><br>';
        $message .= 'Regards,<br>Your Website Team';

        // Send email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: hegdebharat2007@gmail.com' . "\r\n"; // Change this to your email address
        mail($to, $subject, $message, $headers);
    }
}

// Close the database connection
$conn->close();
?>
