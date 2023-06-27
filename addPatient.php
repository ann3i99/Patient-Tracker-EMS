<!DOCTYPE html>

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add new patient</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>

<br>
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
     //echo "You are successfully connected to the Patient Database!". "<br>" ."<br>";

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       // Retrieve the form data
       $pname = $_POST['pname'];
       $tcategory = $_POST['tcategory'];
       $vsigns = $_POST['vsigns'];
       $eresponse = $_POST['eresponse'];

       // Calculate the urgency score
       $uscore = $tcategory * $vsigns;

       // to calculate thre urgency score
       function findElevel ($tcategory,$vsigns){
        if($tcategory==1 && $vsigns==1 || $tcategory==2 && $vsigns==1 || $tcategory==1 && $vsigns==2 ) {
            return 'Minor';
        } elseif ($tcategory==1 && $vsigns==3 || $tcategory==2 && $vsigns==2 || $tcategory==3 && $vsigns==1 ) {
            return 'Moderate';
        } elseif ($tcategory==2 && $vsigns==3 || $tcategory==3 && $vsigns==2 || $tcategory==3 && $vsigns==3 ) {
            return 'Major';
        } else {
            return 'Unknown';
        }
       }

       // Determine the urgency level
        $ulevel = findElevel($tcategory,$vsigns);

       // Perform server-side validation to make sure user fills out the form an dnot leave it empty
       $errors = [];

       // Check if any of the fields are empty
       if (empty($pname)) {
           $errors[] = "Patient name is required.";
       }
       if (empty($tcategory)) {
           $errors[] = "Trilage category is required.";
       }
       if (empty($vsigns)) {
           $errors[] = "Vital Score is required.";
       }
       if (empty($eresponse)) {
           $errors[] = "Emergency response is required.";
       }
   
       // If there are any errors, display them and prevent further processing
       if (!empty($errors)) {
           foreach ($errors as $error) {
               echo $error . "<br>";
           }
           exit();
           }

       }

       // Validate the pname value
       if ($pname === null) {
         echo "Error: 'pname' cannot be null.";
         exit();
       }

       //SQL STATEMENT TO INSERT TO DB
       $sqltoDB = "INSERT INTO patients (pname, tcategory, vsigns, uscore, ulevel, eresponse) VALUES (?,?,?,?,?,?)";

       // Execute the SQL statement to insert the reservation details
       $stmt = mysqli_prepare($connection, $sqltoDB);
       mysqli_stmt_bind_param($stmt, "siiiss", $pname, $tcategory, $vsigns, $uscore, $ulevel, $eresponse);
       mysqli_stmt_execute($stmt);


       // Check if the query executed successfully
       if ($stmt) {
           // Redirect to the page showing the newly added patient information
           echo "New patient added successfully!!". "<br>" ."<br>";
           //exit();
       } else {
           // Handle the case when the query fails
           echo "Error: " . mysqli_error($connection);
       }


       mysqli_stmt_close($stmt);

       // Display the inputted information and the urgency score
       echo "Patient name: $pname<br>";
       echo "Trilage Category: $tcategory<br>";
       echo "Vital Signs: $vsigns<br>";
       echo "Emergency response: $eresponse<br>";
       echo "Urgency score: $uscore<br>";
       echo "Urgency Level: $ulevel<br>";

   ?>


<br/><br/>
<!-- <a href="indexPatient.php">Home</a> -->
<a href="indexPatient.php" type="button" class="btn btn-primary">Home</a>


</body>

</html>




















