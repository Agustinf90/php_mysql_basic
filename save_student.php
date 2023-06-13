<?php
include ("index.php");
if(isset($_POST['save_student'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    $query = "INSERT INTO students(name, description) VALUES ('$name', '$description');";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query failed");
    }

    $_SESSION['message'] = "Student added successfully";
    $_SESSION['message_type'] = "success";
    header("Location: index.php");
    }

?>