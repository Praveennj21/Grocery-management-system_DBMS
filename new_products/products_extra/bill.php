<?php
include('db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $transactionId = $_POST["transaction_id"];
    $productId = $_POST["id"];
    $quantity = $_POST["quantity"];

    // Check remaining quantity before adding to the bill
    $remainingSql = "SELECT remaining FROM products WHERE id = $productId";
    $remainingResult = $conn->query($remainingSql);

    if ($remainingResult->num_rows > 0) {
        $remainingRow = $remainingResult->fetch_assoc();
        $remainingQuantity = $remainingRow["remaining"];

        // Check if remaining quantity is greater than 0
        if ($remainingQuantity > $quantity) {
            // Add product to the bill
            $insertSql = "INSERT INTO bill (transaction_id, id, quantity) VALUES ($transactionId, $productId, $quantity)";
            $conn->query($insertSql);
        } else {
            // Display pop-up window if remaining quantity is 0
            echo "<script>alert('Error: Product has no remaining quantity');</script>";
        }
    } else {
        // Display pop-up window if product is not found
        echo "<script>alert('Error: Product not found');</script>";
    }
}

// Read Operation - Fetch product data
$sql = "SELECT * FROM bill";
$result = $conn->query($sql);

// Display products
$bill = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bill[] = $row;
    }
}

// Fetch low-quantity products for JavaScript
$lowQuantitySql = "SELECT id, name, remaining FROM products WHERE remaining < 20";
$lowQuantityResult = $conn->query($lowQuantitySql);

$lowQuantityProducts = [];

if ($lowQuantityResult->num_rows > 0) {
    while ($row = $lowQuantityResult->fetch_assoc()) {
        $lowQuantityProducts[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'remaining' => $row['remaining'],
        ];
    }
}

// Close the database connection
$conn->close();
?>
<script>
// JavaScript code to check remaining quantity and show pop-up window for low-quantity products
document.addEventListener("DOMContentLoaded", function() {
    <?php foreach ($lowQuantityProducts as $product): ?>
        var remaining = <?php echo $product['remaining']; ?>;
        if (remaining === 0) {
            alert("You are out of stock: Product ID - <?php echo $product['id']; ?>, Name - <?php echo $product['name']; ?>");
        }
    <?php endforeach; ?>
});
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Bill</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Bill</h2>

    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
        Add New Bill
    </button>
    <!-- Button to create a new table and display it -->
    
    <!-- Table to display products -->
    <table class="table mt-3">
        <thead>
        <tr>
            <th>Transaction_ID</th>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($bill as $b): ?>
            <tr>
                <td><?php echo $b['transaction_id']; ?></td>
                <td><?php echo $b['id']; ?></td>
                <td><?php echo $b['name']; ?></td>
                <td><?php echo $b['quantity']; ?></td>
                <td><?php echo $b['amount']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new product -->
                <form action="new_bill.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="transaction_id">Transaction_id :</label>
                        <input type="number" class="form-control" name="transaction_id" required>
                    </div>

                    <div class="form-group">
                        <label for="id">Product id:</label>
                        <input type="number" class="form-control" name="id" required>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" min="0" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add to bill</button>
                </form>
            </div>
        </div>
    </div>
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
