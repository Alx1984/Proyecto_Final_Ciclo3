<?php
include 'conexion.php';
$query = "SELECT * FROM tbl_emails ORDER BY id ASC";
$result = mysqli_query($conexion, $query);
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
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <br /><br />
    <div class="container">
        <h3 align="center">Envio de mensajes</h3>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Envia mensajes a tus <b>Contactos</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" name="add" id="add" data-toggle="modal" data-target="#modal2-wrapper" class="btn btn-warning">Agregar Contacto</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="comment">Mensaje:</label>
                <textarea class="form-control" rows="5" id="comment" id="textoEmail" name="textoEmail"></textarea>
            </div>

            <br />
            <div id="employee_table">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th>Cliente ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Contacto_ID</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="checkbox" value="<?php echo $row["id"]; ?>">
                                    <label for="checkbox1"></label>
                                </span>
                            </td>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["contacto_id"]; ?></td>
                            <td><a data-toggle="modal" data-email="<?php echo $row["email"]; ?>" data-nombre="<?php echo $row["nombre"]; ?>" data-id="<?php echo $row["contacto_id"]; ?>"  href="index.php#modal3-wrapper" class="btn btn-info">Editar</a></td>
                            <td><a href="delete_form.php?borrar=<?php echo $row["email"]; ?>" class="btn btn-danger" name="btnborrar" value="Borrar">Borrar</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>


</html>
<!-- Modal para AGREGAR -->
<div id="modal2-wrapper" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="modal-content animate" action="insert_form.php" method="POST">

                <div class="modal-header">
                    <button type="close" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar un Contacto</h4>
                </div>

                <div class="modal-body">
                    <input type="text" name="cliente_id" class="form-control" placeholder="cliente_id" required="">
                    <br />
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="">
                    <br />
                    <input type="text" name="email" class="form-control" placeholder="correo electronico" required="">
                    <br />
                    <button type="submit" name="agregar" class="btn btn-warning">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal para Modificar -->


<div id="modal3-wrapper" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="modal-content animate" action="edit_form.php" method="POST">

                <div class="modal-header">
                    <button type="close" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Contacto</h4>
                </div>

                <div class="modal-body">
                    <input type="text" name="nombre" class="form-control" value="<?php echo $row["contacto_id"]; ?>" required="" disabled>                    
                    <br />
                    <input type="text" name="nombre" class="form-control" value="<?php echo $row["nombre"]; ?>"  required="">
                    <br />
                    <input type="text" name="email" class="form-control" value="<?php echo $row["email"]; ?>" required="">
                    <br />
                    <button type="submit" name="edit" class="btn btn-info">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('#modal3-wrapper').on('show.bs.modal', function(e) {
        var email = $(e.relatedTarget).data('email');
        $(e.currentTarget).find('input[name="email"]').val(email);
    });    
</script>
<script>
    $('#modal3-wrapper').on('show.bs.modal', function(e) {
        var contacto_id = $(e.relatedTarget).data('contacto_id');
        $(e.currentTarget).find('input[name="contacto_id"]').val(contacto_id);
    });
</script>
<script>
    $('#modal3-wrapper').on('show.bs.modal', function(e) {
        var nombre = $(e.relatedTarget).data('nombre');
        $(e.currentTarget).find('input[name="nombre"]').val(nombre);
    });
</script>