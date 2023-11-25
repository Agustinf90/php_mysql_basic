<?php
include("db.php");
include("includes/header.php");

// Inicializar $userType con un valor predeterminado
$userType = "students";

// Verificar si se ha enviado el formulario
if (isset($_POST['userType'])) {
    // Obtener el valor seleccionado
    $userType = $_POST['userType'];
}

// Construir la consulta SQL según el tipo de usuario seleccionado
$query = "SELECT * FROM $userType";
$result = mysqli_query($conn, $query);

// Verificar si se ha enviado el formulario de guardar
if (isset($_POST['save'])) {
    // Obtener el valor seleccionado
    $userType = $_POST['userType'];

    // Construir la consulta SQL según el tipo de usuario seleccionado
    $query = "INSERT INTO $userType (name, description, created_at) VALUES (?, ?, NOW())";

    // Preparar la consulta
    $stmt = mysqli_prepare($conn, $query);

    // Verificar si la preparación de la consulta tuvo éxito
    if ($stmt) {
        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, 'ss', $name, $description);

        // Obtener los valores del formulario
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Ejecutar la consulta preparada
        mysqli_stmt_execute($stmt);

        // Verificar si se ha realizado con éxito la inserción
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['message'] = 'Record added successfully.';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error adding record.';
            $_SESSION['message_type'] = 'danger';
        }

        // Cerrar la consulta preparada
        mysqli_stmt_close($stmt);

        // Recargar la página para actualizar la tabla mostrada después de la inserción
        header("Location: {$_SERVER['REQUEST_URI']}");
        exit();
    } else {
        // Manejar el error de preparación de la consulta
        die('Error preparing SQL statement.');
    }
}
?>

<!-- El resto del código HTML sigue igual -->

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <!-- Agregar un formulario para seleccionar students o teachers -->
            <form action="" method="POST">
                <div class="form-group">
                    <label for="userType">Select User Type:</label>
                    <select class="form-control" name="userType" onchange="this.form.submit()">
                        <option value="students" <?php if ($userType == "students") echo "selected"; ?>>Students</option>
                        <option value="teachers" <?php if ($userType == "teachers") echo "selected"; ?>>Teachers</option>
                    </select>
                </div>
            </form>

            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?=$_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
                    <?=$_SESSION['message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php session_unset();
            } ?>

            <div class="card" id="card1">
                <form action="" method="POST">
                    <!-- Agregar el campo oculto userType -->
                    <input type="hidden" name="userType" value="<?php echo $userType; ?>">

                    <div class="form-group">
                        <input type="text" name="name" class="form-action" placeholder="Name" autofocus>
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" rows="2" placeholder="Description"></textarea>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="save" value="Save">
                    <input class="btn btn-dark btn-block" name="dark_mode" value="Dark Mode">
                    <input class="btn btn-light btn-block" name="dark_mode" value="Normal Mode">
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo ucfirst($userType); ?></th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['created_at'] ?></td>
                            <td>
                                <a href="edit_<?php echo $userType; ?>.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a href="delete_<?php echo $userType; ?>.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                                <a href="store_proc.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

