<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>delete</title>
     <!-- <script src="delete.js"></script> -->
  </head>
  <body>

    <?php
    require '../config.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// echo '<button onclick="delete()">Call JavaScript Function</button>';
if(isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    // SQL to delete a record
    $sql = "DELETE FROM products WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect after successful deletion
        header('location: products.php');
        exit; // Exit to prevent further execution
    } else {
        // Log the error
        error_log("Error deleting record: " . $conn->error);
        echo "Error deleting record. Please try again later.";
    }
} else {
    echo "No ID specified";
}

// Close connection
$conn->close();
?>


  </body>
</html>
