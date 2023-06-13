<?php include("db.php");?>

<?php include ("includes/header.php");?>
   
<div class = "container p-4">
    <div class="row">
            <div class= "col-md-4">
                <?php if(isset($_SESSION['message'])){ ?>
                    <div class="alert alert-<?=$_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
                        <?=$_SESSION['message']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php session_unset();}?>

            <div class="card" id="card1">
                <form action="save_student.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" class="form-action" placeholder="Name" autofocus>
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" rows="2"
                        placeholder=" Description"></textarea>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="save_student" value="Save">
                    <input class="btn btn-dark btn-block" name="dark_mode" value="Dark Mode">
                    <input class="btn btn-light btn-block" name="dark_mode" value="Normal Mode">
                </form>
            </div>
        </div>
        <div class= "col-md-8">
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Student</th>
            <th>Description</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM students1";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['description']?></td>
            <td><?php echo $row['created_at']?></td>
            <td>
        <a href="edit_student.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
        <i class="fas fa-marker"></i>
        </a>

        <a href="delete_student.php?id=<?php echo $row['id']?>" class="btn btn-danger">
        <i class="far fa-trash-alt"></i>
        </a>
        <a href="store_proc.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
        <i class="far fa-trash-alt"></i>
        </a>
            </td>
        <?php } ?>
        </tr>
    </tbody>
    </table>
    </div>
    </div>

</div>

<?php include ("includes/footer.php");?>
