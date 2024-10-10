<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $id = intval($_POST["id"]);
    $price = floatval($_POST["price"]);
    $quantity = intval($_POST["quantity"]);

    // Check if the product with the given ID exists
    $checkProductSql = "SELECT id, quantity FROM products WHERE id = ?";
    $checkProductStmt = $conn->prepare($checkProductSql);
    $checkProductStmt->bind_param("i", $id);
    $checkProductStmt->execute();
    $checkProductResult = $checkProductStmt->get_result();

    if ($checkProductResult->num_rows > 0) {
        // Product exists, update the quantity
        $existingProduct = $checkProductResult->fetch_assoc();
        $existingQuantity = $existingProduct['quantity'];

        // Calculate the new quantity by adding the existing quantity and the extra quantity
        $newQuantity = $existingQuantity + $quantity;

        // Update the price and quantity in the 'products' table
        $updateSql = "UPDATE products SET price = ?, quantity = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("dii", $price, $newQuantity, $id);
        $result = $updateStmt->execute();

        // Display update result message
        if ($result === TRUE) {
            echo '<script>alert("Product updated successfully!");</script>';
            
        } else {
            echo '<script>alert("Error updating price and quantity: ' . $conn->error . '");</script>';
        }
    

        // Close the prepared statements
        $checkProductStmt->close();
        $updateStmt->close();
        // Close the database connection
        $conn->close();
    } else {
        echo '<script>alert("Product with ID ' . $id . ' does not exist.");</script>';
    }
} else {
    echo '<script>alert("Invalid request method.");</script>';
}
?>
