<?php
include 'conexion.php';
session_start();
$usuario = $_SESSION['usuario'];
$usuarioId = $_SESSION['usuarioId'];
//WHERE id = '$usuarioId' 
$query = "SELECT * FROM tbl_emails WHERE id = '$usuarioId'";
$result = mysqli_query($conexion, $query);



// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
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
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <br /><br />
    <div class="container">
    <div class="col-md-12">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"> Importar Contactos</i></a>
        </div>
    </div>
    <br/>
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="import_Data.php" method="post" enctype="multipart/form-data">
            CSV File:<input type="file" name="file" id="file">
            <input type="submit" class="btn btn-primary" name="enviar" value="IMPORT">
        </form>
    </div>

    <div></div>



        <h3 align="center">Envio de mensajes</h3>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Envia mensajes a tus <b>Contactos : <?php echo $usuario; ?></b> <br /><b>ID: <?php echo $usuarioId; ?></b></h2>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" name="add" id="add" data-toggle="modal" data-target="#modal2-wrapper" class="btn btn-warning">Agregar Contacto</button>
                        <a href="lista_form.php"><button type="button" name="edit" id="add" data-target="edit_form.php" class="btn btn-info">Editar Contactos</button></a>
                    </div>
                </div>
            </div>
            <form action="envioEmail.php" method="post">
                <div class="form-group">
                    <label for="comment">Mensaje:</label>
                    <textarea class="form-control" rows="5" id="comment" id="textoEmail" name="textoEmail"></textarea>
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
                                <td><a href="delete_form.php?borrar=<?php echo $row["email"]; ?>" class="btn btn-danger" name="btnborrar" value="Borrar">Borrar</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <div class="col-sm-24">
                        <button type="submit" name="enviar" id="enviar"  class="btn btn-success">Enviar Mensaje a todos tus contactos!</button>
                        <?php $_SESSION['usuarioId'] = $usuarioId?>
                    </div>
                </div>
                

            </form>


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
                    <input type="text" name="cliente_id" class="form-control" placeholder="cliente_id" required="" value="<?php echo $usuarioId; ?>" readonly="readonly">
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

<script>
    function formToggle(ID){
        var element = document.getElementById(ID);
        if (element.style.display == "none") {
            element.style.display = "block";
        }
        else{
            element.style.display = "none";
        }
    }

</script>


