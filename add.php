<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add new patient</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  
</head>
<body>
  <h1>Add a new patient</h1>
  <p><strong>Enter the patient information </strong></p>
  <form action="addPatient.php" method="post">
    <table width="70%">
      <tr>
        <td>Patient Name: </td>
        <td><input type="text" name="pname"></td>
      </tr>
      <tr>
        <td> Triage Category: </td>
        <td><input type="text" name=" tcategory"></td>
      </tr>
      <tr>
        <td> Vital Signs: </td>
        <td><input type="text" name="vsigns"> </td>
      </tr>
      <tr>
        <td> Emergency Response: </td>
        <td><input type="text" name="eresponse"> </td>
      </tr>
      <tr>
        <td> </td>
        <td>
          <input type="submit" name="Submit" value="Add Patient" class="btn btn-primary">
        </td>
      </tr>
    </table>
  </form>
</body>
</html>