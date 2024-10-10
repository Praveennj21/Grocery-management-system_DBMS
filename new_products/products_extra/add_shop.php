<?php
// Include the database connection file
include('db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $shop_id = $_POST['shop_id'];
    $address = $_POST['address'];
    $owner = $_POST['owner'];
    $manager = $_POST['manager'];
    $phone = $_POST['phone'];
    $license_no = $_POST['license_no'];

    // Prepare the SQL statement
    $sql = "INSERT INTO shop (name, shop_id, address, owner, manager, phone, license_no) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("sisssis", $name, $shop_id, $address, $owner, $manager, $phone, $license_no);
        $result = $stmt->execute();

        if ($result) {
            echo "Shop data added successfully.";
        } else {
            echo "Error adding shop data: " . $conn->error;
        }
    } else {
        echo "Error preparing SQL statement: " . $conn->error;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
