<?php
// Include the database connection file
include('db.php');

// Function to get shop name by shop ID
function getShopName($conn, $shop_id) {
    $sql = "SELECT name FROM shop WHERE shop_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $shop_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name'];
    } else {
        return "N/A";
    }
}

// Fetch all employees
$sql = "SELECT * FROM Employee";
$result = $conn->query($sql);

// Check if there are rows in the result for all employees
if ($result->num_rows > 0) {
    // Output data of each row for all employees
    echo "<h2>All Employee Data</h2>";
    echo "<table class='table mt-3'>
            <tr>
                <th>Employee ID</th>
                <th>Shop ID</th>
                <th>Shop Name</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['emp_id'] . "</td>";
        echo "<td>" . $row['shop_id'] . "</td>";
        // Get and display shop name
        echo "<td>" . getShopName($conn, $row['shop_id']) . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No employee data found.";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    // Retrieve shop ID from the form
    $search_shop_id = $_POST['search_shop_id'];
    // SQL query to fetch employees by shop ID
    $sql = "SELECT * FROM Employee WHERE shop_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $search_shop_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Output data of each row for search results
        echo "<h2>Search Result</h2>";
        echo "<table class='table mt-3'>
                <tr>
                    <th>Employee ID</th>
                    <th>Shop ID</th>
                    <th>Shop Name</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['emp_id'] . "</td>";
            echo "<td>" . $row['shop_id'] . "</td>";
            // Get and display shop name
            echo "<td>" . getShopName($conn, $row['shop_id']) . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No employees found for Shop ID: $search_shop_id";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
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
<div class="navigation-container">
        <a href="dashboard.php" class="navigation-icon">
            <!-- You can use an icon font, image, or other methods for the icon -->
            <!-- For simplicity, I'll use a Unicode arrow character ▶ -->
            ▶
        </a>
    </div>

<div class="container mt-4">
    <h2>Search Employee by Shop ID</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="search_shop_id">Enter Shop ID:</label>
            <input type="number" class="form-control" id="search_shop_id" name="search_shop_id" required>
        </div>
        <button type="submit" class="btn btn-primary" name="search">Search</button>
    </form>
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
