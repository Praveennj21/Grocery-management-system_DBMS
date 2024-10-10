<?php
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
    // If no low quantity products, handle accordingly (redirect, show a message, etc.)
    echo "No products with remaining quantity less than 20 found.";
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
    <title>Low Quantity Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Low Quantity Products</h2>

    <!-- Table to display low quantity products -->
    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Remaining </th>
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
