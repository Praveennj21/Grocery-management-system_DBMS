<?php
include('db.php');

// Fetch transaction and total amount data using a JOIN
$sql = "SELECT b.transaction_id, COALESCE(SUM(b.amount), 0) AS total_amount
        FROM bill b
        GROUP BY b.transaction_id";

$result = $conn->query($sql);

// Process the combined data
$transactionTotals = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Store the combined data in the $transactionTotals array
        $transactionTotals[] = [
            'transaction_id' => $row['transaction_id'],
            'total_amount' => $row['total_amount'],
        ];

        // Insert into the "total_amount" table inside the loop
        $transactionId = $row['transaction_id'];
        $totalAmount = $row['total_amount'];

        $insertSql = "INSERT INTO total_amount (transaction_id, total) VALUES ($transactionId, $totalAmount)";
        $conn->query($insertSql);
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Amounts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Total Amounts</h2>

    <!-- Table to display total amounts -->
    <table class="table mt-3">
        <thead>
        <tr>
            <th>Transaction ID</th>
            <th>Total Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($transactionTotals as $total): ?>
            <tr>
                <td><?php echo $total['transaction_id']; ?></td>
                <td><?php echo $total['total_amount']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<style>
        .navigation-container {
            position: fixed;
            top: 50px; /* Adjust the top distance as needed */
            right: 50px; /* Adjust the right distance as needed */
            z-index: 1000; /* Ensure the icon stays on top of other elements */
        }

        .navigation-icon {
            display: inline-block;
            font-size: 35px; /* Adjust the font size as needed */
            text-decoration: none;
            color: #007bff; /* Set the color of the icon */
            transform: rotate(180deg);
        }
    </style>
    <div class="container mt-5">
    <!-- Your existing content -->

    <!-- Container for the navigation icon -->
    <div class="navigation-container">
        <a href="dashboard.php" class="navigation-icon">
            <!-- You can use an icon font, image, or other methods for the icon -->
            <!-- For simplicity, I'll use a Unicode arrow character ▶ -->
            ▶
        </a>
    </div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>