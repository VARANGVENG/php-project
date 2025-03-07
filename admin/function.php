<!-- @import jquery & sweet alert  -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>



// insert product 

<?php
$servername = "localhost"; // Change this if needed
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "your_database_name"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $companyname = $_POST["companyname"];
    $phonenumber = $_POST["phonenumber"];
    $emailaddress = $_POST["emailaddress"];
    $country = $_POST["country"];
    $addressline1 = $_POST["addressline1"];
    $addressline2 = $_POST["addressline2"];
    $city = $_POST["city"];
    $district = $_POST["district"];
    $postcode = $_POST["postcode"];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO customers (firstname, lastname, companyname, phonenumber, emailaddress, country, addressline1, addressline2, city, district, postcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssi", $firstname, $lastname, $companyname, $phonenumber, $emailaddress, $country, $addressline1, $addressline2, $city, $district, $postcode);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the connection
    $stmt->close();
}

$conn->close();

// update product


$servername = "localhost"; // Change this if needed
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "your_database_name"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing product details
$product = null;
if ($id > 0) {
    $result = $conn->query("SELECT * FROM products WHERE id = $id");
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found!");
    }
}

// Update product when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    // Prepare update statement
    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, stock=? WHERE id=?");
    $stmt->bind_param("ssdii", $name, $description, $price, $stock, $id);

    // Execute update
    if ($stmt->execute()) {
        $message = "Product updated successfully!";
        $alertClass = "alert-success";
    } else {
        $message = "Error updating product: " . $stmt->error;
        $alertClass = "alert-danger";
    }

    // Refresh product data
    $stmt->close();
    $result = $conn->query("SELECT * FROM products WHERE id = $id");
    $product = $result->fetch_assoc();
}

$conn->close();


// delete product

$servername = "localhost"; // Change this if needed
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "your_database_name"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the product ID

    // Prepare delete statement
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute delete
    if ($stmt->execute()) {
        $message = "Product deleted successfully!";
        $alertClass = "alert-success";
    } else {
        $message = "Error deleting product: " . $stmt->error;
        $alertClass = "alert-danger";
    }

    $stmt->close();
} else {
    $message = "No product ID provided!";
    $alertClass = "alert-warning";
}

$conn->close();


// view product 

$servername = "localhost"; // Change this if needed
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "your_database_name"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Product List</h2>
    <a href="add_product.php" class="btn btn-success mb-3">+ Add New Product</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price ($)</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo htmlspecialchars($row["name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["description"]); ?></td>
                        <td><?php echo number_format($row["price"], 2); ?></td>
                        <td><?php echo $row["stock"]; ?></td>
                        <td>
                            <a href="update_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this product?');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">No products found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php $conn->close(); ?>

