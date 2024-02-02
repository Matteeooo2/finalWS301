<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .add-button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .edit-button {
            background-color: #2196f3;
            color: white;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            cursor: pointer;
            border-radius: 4px;
        }
        .butonRow{
            display: flex;
            justify-content: space-evenly;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Product Data</h2>

<?php
include '..//phpUx/db_connection.php';

try {
    $conn = connectDB();

    if ($conn) {
        $sql = "SELECT
        appointment.ap_id,
        patient.p_id,
        patient.p_name,
        SCHEDULE.scd_id,
        SCHEDULE.scd_time,
        SCHEDULE.scd_date
    FROM
        appointment
    INNER JOIN patient ON appointment.p_id = patient.p_id
    INNER JOIN SCHEDULE ON appointment.scd_id = SCHEDULE.scd_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table class='table table-striped'>
        <tr class='table-dark'>
                    <th>Appointment ID</th>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <th>Time</th>
                    <th>Date</th>
                    
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['ap_id']}</td>
                    <td>{$row['p_id']}</td>
                    <td>{$row['p_name']}</td>
                    <td>{$row['scd_id']}</td>
                    <td>{$row['scd_date']}</td>
                </tr>";
        }
        echo "</table>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if ($conn) {
        $conn = null;
    }
}
?>

<div class="button-container">
    <a href="appointform.php" class="add-button">Add Appointment</a>
</div>

</div>

</body>
</html>