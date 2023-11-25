<?php 
include("db.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM teachers WHERE id = $id";
    $result = mysqli_query($conn, $query);
   
    if(mysqli_num_rows($result) == 1){
       $row = mysqli_fetch_array($result);
       $name = $row['name'];
       $description = $row['description']; 
    }
}

if(isset($_POST['update'])){
    $id = $_GET['id'];
    $name = $_POST['name'];
    $description = $_POST['description']; 
    echo $id;
    echo $name;
    $query = "UPDATE teachers SET name = '$name', description = '$description' WHERE id = $id";
    mysqli_query($conn, $query);
    $_SESSION['message'] = 'Teacher Updated Successfully';
    $_SESSION['message_type'] = 'warning';
    header('Location: index.php');
    }

?>

<?php include ("includes/header.php");?>

<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_teachers.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
          <input name="name" type="text" class="form-control" value="<?php echo $name; ?>" placeholder="Update Title">
        </div>
        <div class="form-group">
        <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $description;?></textarea>
        </div>
        <button class="btn-success" name="update">
          Update
</button>
      </form>
      </div>
    </div>
  </div>
</div>

<?php include ("includes/footer.php");?>