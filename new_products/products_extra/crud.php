<html>
<head>
    <title>CRUD Operations</title>
</head>
<body>
    <h1>CRUD Operations</h1>
    <h2>Create (Insert) Data</h2>
    <form method="post" action="crud.php">
	    ID: <input type="text" name="create_id"><br>
        Name: <input type="text" name="create_name"><br>
        Email: <input type="text" name="create_email"><br>
        <input type="submit" name="create" value="Create">
    </form>

    <h2>Read (Retrieve) Data</h2>
    <form method="post" action="crud.php">
        <input type="submit" name="read" value="Read">
    </form>
   

    <h2>Update Data</h2>
    <form method="post" action='crud.php'>
        ID: <input type="text" name="update_id"><br>
        New Name: <input type="text" name="update_name"><br>
        New Email: <input type="text" name="update_email"><br>
        <input type="submit" name="update" value="Update">
    </form>

    <h2>Delete Data</h2>
    <form method="post" action='crud.php'>
        ID: <input type="text" name="delete_id"><br>
        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>


<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["create"])) {
	$id = $_POST["create_id"];
    $name = $_POST["create_name"];
    $email = $_POST["create_email"];
    
    $sql = "INSERT INTO users (id ,name, email) VALUES ('$id','$name', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST["read"])) {
    $sql = "SELECT id, name, email FROM users";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
        }
    } else {
        echo "0 results";
    }
}

if (isset($_POST["update"])) {
    $id = $_POST["update_id"];
    $newName = $_POST["update_name"];
    $newEmail = $_POST["update_email"];
    
    $sql = "UPDATE users SET name='$newName', email='$newEmail' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST["delete"])) {
    $id = $_POST["delete_id"];
    
    $sql = "DELETE FROM users WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
