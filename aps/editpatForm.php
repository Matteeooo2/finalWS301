<?php

include 'db_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Perform database update
    try {

        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE patient SET p_name = :name, p_age = :email WHERE p_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        // Redirect to the page displaying the updated user or any other page
        header("Location: ..//aps/patientForm.php?error=success");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>
