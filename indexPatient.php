<?php  
//Establish database connection (replace with your credentials)
$host = "localhost"; // Database host
$username = "manager"; // Database username
$password = "mgr123"; // Database password
$database = "patientdb"; // Database name

$connection = new mysqli('localhost', 'manager', 'mgr123', 'patientdb');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

//testing to see if connected to db
//echo "You are successfully connectd to the Patient Database!";
?>


<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        table,
        th,
        td,
        tr {
            border: 1px solid black;
        }
    </style>
    </style>
</head>

<body>
    <h1>Patient Register</h1>
    <!-- <a href="add.php" target="_blank">Add New Patient</a><br/><br/> -->
    <a href="add.php" type="button" class="btn btn-primary">Add New Patient </a><br/><br/>

    <table>

        <tr>
            <th>Patient Name</th>
            <th>Triage Category</th>
            <th>Vital Signs</th>
            <th>Urgency Score</th>
            <th>Urgency Level</th>
            <th>Emergency Response</th>
        </tr>

        <?php
        
        // Query to retrieve patient information sorted by emergency level
        $query = "SELECT * FROM patients ORDER BY CASE 
        WHEN ulevel = 'major' THEN 1
        WHEN ulevel = 'moderate' THEN 2
        WHEN ulevel = 'minor' THEN 3
        ELSE 4 END";

        // Execute the query
        $result = mysqli_query($connection, $query);

        // Check if the query executed successfully
        if ($result) {
          // Fetch the data from the result
          while ($row = mysqli_fetch_assoc($result)) {
          // Access individual fields
          $pname = $row['pname'];
          $tcategory = $row['tcategory'];
          $vsigns = $row['vsigns'];
          $uscore = $row['uscore'];
          $ulevel = $row['ulevel'];
          $eresponse = $row['eresponse'];

          // Add a new row to the table with the retrieved data
          echo "<tr>
                    <td>$pname</td>
                    <td>$tcategory</td>
                    <td>$vsigns</td>
                    <td>$uscore</td>
                    <td>$ulevel</td>
                    <td>$eresponse</td>
                </tr>";
          }
        
        } else {
        // Handle the case when the query fails
        echo "Error: " . mysqli_error($connection);
        }

        // Close the database connection
        mysqli_close($connection);

        ?>
    </table>
</body>

</html>