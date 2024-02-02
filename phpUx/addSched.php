<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST['times'];
    $stock = $_POST['dates'];

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO schedule (scd_time, scd_date) VALUES (:prod, :sto)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':prod', $pname);
        $stmt->bindParam(':sto', $stock);
        $stmt->execute();

        // Redirect back to the user data page after successful insertion
        header("Location: ..//phpUi/appointForm.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Always close the connection
        if ($conn) {
            $conn = null;
        }
    }
}
?>
