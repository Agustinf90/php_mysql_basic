<?php 
include("db.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM teachers WHERE id = $id";
    $result = mysqli_query($conn, $query);
   
    if(!$result){
        die("Query failed");
    }

    $_SESSION['message'] = "Teacher removed successfully";
    $_SESSION['message_type'] = "danger";

    header("Location: index.php");

}

?>