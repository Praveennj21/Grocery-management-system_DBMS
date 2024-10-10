<?php
session_start();
include('db.php');

// Fetch products with remaining quantity less than 20
$sql = "SELECT id, name, remaining FROM products WHERE remaining < 20";
$result = $conn->query($sql);

$lowQuantityProducts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lowQuantityProducts[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'remaining' => $row['remaining'],
        ];
    }
} else {
    // If no low quantity products, redirect to the main page
    header("Location: notification_page.php");
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Quantity Products Notification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Low Quantity Products Notification</h2>

    <!-- Table to display low quantity products -->
    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Remaining Quantity</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($lowQuantityProducts as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['remaining']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
