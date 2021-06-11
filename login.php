<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Simple Login Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
</head>
<body>
<div class="login-form">
    <form action="valida_login.php" method="post">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input type="text" class="form-control" name="usuario" placeholder="Usuario" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="contra" placeholder="Contraseña" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
        </div>
    </form>
    <p class="text-center"><a data-toggle="modal" data-target="#modal2-wrapper">Crear Cuenta</a></p>
</div>
</body>
</html>

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