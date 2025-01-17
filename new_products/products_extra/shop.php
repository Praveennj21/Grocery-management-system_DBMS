<?php
// Include the database connection file
include('db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $owner = $_POST['owner'];
    $manager = $_POST['manager'];
    $phone = $_POST['phone'];
    $license_no = $_POST['license_no'];

    // Prepare the SQL statement
    $sql = "INSERT INTO shop (name, address, owner, manager, phone, license_no) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ssssss", $name, $address, $owner, $manager, $phone, $license_no);
        $result = $stmt->execute();

        if ($result) {
            echo "Shop data added successfully.";
            // Redirect to avoid form resubmission
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error adding shop data: " . $stmt->error;
        }
    } else {
        echo "Error preparing SQL statement: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// SQL query to fetch all shop data
$sql = "SELECT * FROM shop";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<h2>Shop Data</h2>";
    echo "<table class='table mt-3'>
            <tr>
            <th>Shop ID </th>
                <th>Name</th>
                <th>Address</th>
                <th>Owner</th>
                <th>Manager</th>
                <th>Phone</th>
                <th>License No</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['shop_id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['owner'] . "</td>";
        echo "<td>" . $row['manager'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['license_no'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No shop data found.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shop Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
</head>
<body>

<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addShopModal">
    Add Shop Details
</button>

<!-- Modal -->
<div class="modal fade" id="addShopModal" tabindex="-1" role="dialog" aria-labelledby="addShopModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addShopModalLabel">Add Shop Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to add new shop details -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="owner">Owner:</label>
                        <input type="text" class="form-control" id="owner" name="owner" required>
                    </div>
                    <div class="form-group">
                        <label for="manager">Manager:</label>
                        <input type="text" class="form-control" id="manager" name="manager" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="license_no">License Number:</label>
                        <input type="text" class="form-control" id="license_no" name="license_no" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Shop</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="navigation-container">
        <a href="dashboard.php" class="navigation-icon">
            <!-- You can use an icon font, image, or other methods for the icon -->
            <!-- For simplicity, I'll use a Unicode arrow character ▶ -->
            ▶
        </a>
    </div>
<!-- Bootstrap JS and jQuery (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
