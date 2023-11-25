<?php 
include("db.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query1 = "DROP procedure IF EXISTS php_proc2;";
    $result1 = mysqli_query($conn, $query1);
    $query2 = "create procedure php_proc2 (id_Test int(40))
    begin
    update students set name = 'eh sio4', description = 'prosesao3' where id = id_Test;
    end ";
    $result2 = mysqli_query($conn, $query2);
    if($result2){
        $query3 = "CALL php_proc2 ($id)";
        $result3 = mysqli_query($conn, $query3);
    }
    $_SESSION['message'] = 'Student Updated Successfully';
    $_SESSION['message_type'] = 'warning';
    header('Location: index.php');
   
}


?>