<?php
require_once 'connect.php';

if(isset($_POST['add'])){
  try {
    $stmt = $dbh->prepare("INSERT INTO CottageRentInfo (firstName, lastName, NumberOfGuests, Price) 
                            VALUES (:firstName, :lastName, :NumberOfGuests, :Price)");
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':NumberOfGuests', $NumberOfGuests);
    $stmt->bindParam(':Price', $Price);

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $NumberOfGuests = $_POST['NumberOfGuests'];
    $Price = $_POST['Price'];

    $stmt->execute();
    echo "<p style='color: green; font-weight: bold;'>New record created successfully</p>";
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

if(isset($_POST['update'])){
  try {
    $stmt = $dbh->prepare("UPDATE CottageRentInfo SET firstName=:firstName, lastName=:lastName, 
                            NumberOfGuests=:NumberOfGuests, Price=:Price WHERE Id=:Id");
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':NumberOfGuests', $NumberOfGuests);
    $stmt->bindParam(':Price', $Price);
    $stmt->bindParam(':Id', $Id);

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $NumberOfGuests = $_POST['NumberOfGuests'];
    $Price = $_POST['Price'];
    $Id = $_POST['Id'];

    $stmt->execute();
    echo "<p style='color: green; font-weight: bold;'>Record updated successfully</p>";
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

if(isset($_POST['delete'])){
  try {
    $stmt = $dbh->prepare("DELETE FROM CottageRentInfo WHERE Id=:Id");
    $stmt->bindParam(':Id', $Id);

    $Id = $_POST['Id'];

    $stmt->execute();
    echo "<p style='color: green; font-weight: bold;'>Record deleted successfully</p>";
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

try {
  $stmt = $dbh->prepare("SELECT * FROM CottageRentInfo");
  $stmt->execute();
  $result = $stmt->fetchAll();
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cottage Rent Info</title>
  <link rel="stylesheet" href="css/style.css">
  <link href='https://fonts.googleapis.com/css?family=Didact Gothic' rel='stylesheet'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,400&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Neonderthaw&family=Roboto:ital,wght@0,300;1,400&display=swap" rel="stylesheet">
</head>
  <body>

    <video autoplay muted loop>
        <source src="images/cottage.mp4" type="video/mp4">
    </video>

    <div style='position:static;'></div>  
    <div class='grid-container'>

            <div class='box header'>
              <h1>"Assignment #6"  /  Amir Hosein Khanmohammadi</h1>
              <h1>Cottage Rent Info</h1>
            </div>

            <div class='box Add-container'>
                <h2>Add new record</h2><br>
                <form method="post">
                    <label for="firstName">First Name:</label>
                    <input class="input" type="text" id="firstName" name="firstName"><br><br>
                    <label for="lastName">Last Name:</label>
                    <input class="input" type="text" id="lastName" name="lastName"><br><br>
                    <label for="NumberOfGuests">Number Of Guests:</label>
                    <input class="input" type="number" id="NumberOfGuests" name="NumberOfGuests"><br><br>
                    <label for="Price">Price:</label>
                    <input class="input" type="number" id="Price" name="Price"><br><br>
                    <button type="submit" name="add">Add Record</button>
                </form>
            </div>

            <div class='box Update-container'>
                <h2>Update record</h2><br>
                <form method="post">
                    <label for="Id">Id:</label>
                    <input class="input" type="number" id="Id" name="Id"><br><br>
                    <label for="firstName">First Name:</label>
                    <input class="input" type="text" id="firstName" name="firstName"><br><br>
                    <label for="lastName">Last Name:</label>
                    <input class="input" type="text" id="lastName" name="lastName"><br><br>
                    <label for="NumberOfGuests">Number Of Guests:</label>
                    <input class="input" type="number" id="NumberOfGuests" name="NumberOfGuests"><br><br>
                    <label for="Price">Price:</label>
                    <input class="input" type="number" id="Price" name="Price"><br><br>
                    <button type="submit" name="update">Update Record</button>
                </form>

            </div>

            <div class='box Delete-container'>
                <h2>Delete record</h2><br>
                <form method="post">
                    <label for="Id">Id:</label>
                    <input class="input" type="number" id="Id" name="Id"><br><br>
                    <button type="submit" name="delete">Delete Record</button>
                </form>
            </div>


            <div class='box table-container'>
              <h2>Records in database</h2><br>
              <table>
                <tr>
                  <th>Id</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Number Of Guests</th>
                  <th>Price</th>
                </tr>
                <?php foreach ($result as $row) { ?>
                <tr>
                  <td><?php echo $row['Id']; ?></td>
                  <td><?php echo $row['firstName']; ?></td>
                  <td><?php echo $row['lastName']; ?></td>
                  <td><?php echo $row['NumberOfGuests']; ?></td>
                  <td><?php echo '$' . $row['Price']; ?></td>
                </tr>
                <?php } ?>
              </table>
            </div>

            <footer class='box footer'>
                <p class="footer-content">Copyright © 2023 Amir H Khanmohammadi<br>
                Email: <a href="mailto:khanmoam@sheridancollege.ca">khanmoam@sheridancollege.ca</a></p>
            </footer>
    </div>
  </body>
</html>