<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #container {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .button-container {
            text-align: center;
        }

        .update-button {
            background-color: #2196f3;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Edit Product </h2>

    <?php
    include '..//aps/db_connection.php';

    try {
        $conn = connectDB();

        if ($conn && isset($_POST['edit_product_id'])) {
            $prodID = $_POST['edit_product_id'];
            $sql = "SELECT scd_id, scd_time, scd_date FROM schedule WHERE scd_id = :pid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pid', $prodID);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                // User data found, render the edit form
    ?>
                <form action="..//phpUx/editSched.php" method="post">
                    <input type="hidden" name="pid" value="<?php echo $userData['scd_id']; ?>">
                    <label for="name">Name:</label>
                    <input type="time" name="times" id="pname" value="<?php echo $userData['scd_time']; ?>">

                    <label for="email">Email:</label>
                    <input type="date" name="dates" id="pstock" value="<?php echo $userData['scd_date']; ?>">

                    <div class="button-container">
                        <button type="submit" class="update-button">Update User</button>
                    </div>
                </form>
    <?php
            } else {
                echo "<p>User not found.</p>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if ($conn) {
            $conn = null;
        }
    }
    ?>
</div>

</body>
</html>
