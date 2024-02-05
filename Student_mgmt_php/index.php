<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "student_db";
 
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 
 // Process form actions
 if (isset($_GET['action'])) {
     if ($_GET['action'] == 'insert') {
         $roll_no = $_POST['roll_no'];
         $name = $_POST['name'];
         $section = $_POST['section'];
         $address = $_POST['address'];
         $phone_number = $_POST['phone_number'];
 
         $sql = "INSERT INTO students (roll_no, name, section, address, phone_number) 
                 VALUES ('$roll_no', '$name', '$section', '$address', '$phone_number')";
 
         if ($conn->query($sql) === TRUE) {
             echo "Student added successfully";
         } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
         }
     } elseif ($_GET['action'] == 'update') {
         // Update data in the database
         $roll_no_update = $_POST['roll_no_update'];
         $name_update = $_POST['name_update'];
         $section_update = $_POST['section_update'];
         $address_update = $_POST['address_update'];
         $phone_number_update = $_POST['phone_number_update'];
 
         $update_sql = "UPDATE students SET 
                         name = IFNULL('$name_update', name),
                         section = IFNULL('$section_update', section),
                         address = IFNULL('$address_update', address),
                         phone_number = IFNULL('$phone_number_update', phone_number)
                        WHERE roll_no = '$roll_no_update'";
 
         if ($conn->query($update_sql) === TRUE) {
             echo "Student updated successfully";
         } else {
             echo "Error: " . $update_sql . "<br>" . $conn->error;
         }
     } elseif ($_GET['action'] == 'delete') {
         // Delete data from database
         $roll_no_delete = $_POST['roll_no_delete'];
 
         $sql = "DELETE FROM students WHERE roll_no='$roll_no_delete'";
 
         if ($conn->query($sql) === TRUE) {
             echo "Student deleted successfully";
         } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
         }
     }
 }
 
 // Display student list
 $sql = "SELECT * FROM students";
 $result = $conn->query($sql);
 
 if ($result->num_rows > 0) {
     echo "<ul>";
     while ($row = $result->fetch_assoc()) {
         echo "<li>{$row['roll_no']} - {$row['name']} - {$row['section']} - {$row['address']} - {$row['phone_number']}</li>";
     }
     echo "</ul>";
 } else {
     echo "<br> No students found.";
 }
 
 $conn->close();
 ?>
 