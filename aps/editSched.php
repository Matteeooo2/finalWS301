<?php

include 'db_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $pid = $_POST["pid"];
    $pname = $_POST["times"];
    $pstock = $_POST["dates"];

    // Perform database update
    try {

        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE schedule SET scd_time = :pname, scd_date = :pstock WHERE scd_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $pid);
        $stmt->bindParam(':pname', $pname);
        $stmt->bindParam(':pstock', $pstock);

        $stmt->execute();

        // Redirect to the page displaying the updated user or any other page
        header("Location: ..//aps/appointForm.php?error=success");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>
