<?php
include 'conexion.php';
session_start();
$nivel = $_SESSION['nivel'];
$clienteId = $_SESSION['id'];

if ($nivel == 'admin') {
    $query = "SELECT * FROM tbl_emails ORDER BY id ASC";
    $result = mysqli_query($conexion, $query);
}else {
    $query = "SELECT * FROM tbl_emails WHERE id = '$clienteId' ORDER BY id ASC";
    $result = mysqli_query($conexion, $query);
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Envio de Correos</title>
    <!-- Brarry Css js   -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- css add external -->
    <link rel="stylesheet" href="../css/styles.css">
    <title>Envio de Mensajes</title>
    <link rel="icon" type="image/png" href="../img/Iconmsn.png" />

</head>

<body>
    <br /><br />
    <div class="container">
        <h3 align="center">Envio de mensajes</h3>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Edita tus <b>Contactos</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="desconectar.php"><button type="button" name="desconectar" id="desconectar"  class="btn btn-danger">Cerrar</button></a>
                        <a href="dashboard.php"><button type="button" name="edit" id="add"  data-target="edit_form.php" class="btn btn-warning">Regresar</button></a>
                    </div>
                </div>
            </div>

            <br />
            <div id="employee_table">

                <table class="table table-striped table-hover">
                    <tr>
                        <th>Cliente ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Contacto_ID</th>
                        <th>Borrar</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["contacto_id"]; ?></td>
                            <td><a href="lista_form.php?editar=<?php echo $row["email"]; ?>" class="btn btn-info" name="btnEditar" value="Editar">Editar</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>

            </div>
        </div>
    </div>
    </div>
    <?php
    include 'edit_form.php';
    ?>
<!--tabla para editar-->
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Edita tus <b>Contactos</b></h2>
                    </div>
                </div>
            </div>

            <br />
            <div id="employee_table">
                <form action="update_form.php" method="post">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Cliente ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Contacto_ID</th>
                            <th>Borrar</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="cliente_id" class="form-control" value="<?php echo $rid ?>" placeholder="cliente_id" required="" readonly="readonly"></td>
                            <td><input type="text" name="nombre" class="form-control" value="<?php echo $rnombre ?>" placeholder="Nombre" required=""></td>
                            <td><input type="text" name="email" class="form-control" value="<?php echo $remail ?>" placeholder="Email" required=""></td>
                            <td><input type="text" name="contacto_id" class="form-control" value="<?php echo $rcontacto_id ?>" placeholder="Contacto_Id" required="" readonly="readonly"> </td>
                            <td><button type="submit" name="update" id="update" class="btn btn-success">Actualizar</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>

</html>