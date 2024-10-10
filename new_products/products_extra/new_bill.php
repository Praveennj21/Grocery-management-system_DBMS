<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST["transaction_id"];
    $id = $_POST["id"];
    $quantity = $_POST["quantity"];

    // Check remaining quantity before adding to the bill
    $remainingSql = "SELECT remaining FROM products WHERE id = ?";
    $remainingStmt = $conn->prepare($remainingSql);
    $remainingStmt->bind_param("i", $id);
    $remainingStmt->execute();
    $remainingResult = $remainingStmt->get_result();

    // Check if the remaining quantity is greater than 0
    if ($remainingResult) {
        $remainingRow = $remainingResult->fetch_assoc();
        if ($remainingRow && $remainingRow['remaining'] >= $quantity) {
            // Fetch the name and price from the products table based on the given ID
            $productSql = "SELECT name, price FROM products WHERE id = ?";
            $productStmt = $conn->prepare($productSql);
            $productStmt->bind_param("i", $id);
            $productStmt->execute();
            $productResult = $productStmt->get_result();

            // Check if the product details were fetched successfully
            if ($productResult) {
                $productRow = $productResult->fetch_assoc();
                if ($productRow) {
                    // Calculate the amount based on quantity and price
                    $amount = $quantity * $productRow['price'];

                    // Insert product into the bill table using a prepared statement
                    $sql = "INSERT INTO bill (transaction_id, id, name, quantity, amount) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("issds", $transaction_id, $id, $productRow['name'], $quantity, $amount);
                    $stmt->execute();

                    // Close the prepared statements
                    $stmt->close();
                    $productStmt->close();

                    // Redirect to the bill.php page
                    header('Location: bill.php');
                    exit(); // Ensure that the script stops execution after redirect
                } else {
                    echo "Error fetching product details from products table: " . $conn->error;
                }
            }
        } else {
            // Display pop-up window if remaining quantity is insufficient
            echo "<script>alert('Error: Insufficient product quantity');</script>";
         
        }
    }

    // Close the remaining quantity prepared statement
    $remainingStmt->close();
}

// Close the database connection
$conn->close();
?>
