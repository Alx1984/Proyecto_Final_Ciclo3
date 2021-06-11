<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<title>Document</title>
</head>
<body>
<?php
require 'conexion.php';
session_start();

$usuarioId = $_SESSION['usuarioId'];
$usuario = $_SESSION['usuario'];
$textoEmail = $_POST['textoEmail'];


//Include required PHPMailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$query = "SELECT email, nombre, contacto_id FROM tbl_emails WHERE id = '$usuarioId'";
$result = mysqli_query($conexion, $query);
$numrows = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)){	


//Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "tls";
//Port to connect smtp
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "grupoitcasv21@gmail.com";
//Set gmail password
	$mail->Password = "Secreto21";
//Email subject
	$mail->Subject = "Prueba desde PHPMailer";
//Set sender email
	$mail->setFrom('grupoitcasv21@gmail.com');
//Enable HTML
	$mail->isHTML(true);
//Email body
	$mail->Body = "<h1>Noticia importante Grupo ITCA</h1></br><p> $textoEmail</p>";
//Add recipient
//$mail->addAddress($emailArray);
$mail->AddCC($row["email"], $row["nombre"]);

$contactonombre = $row["nombre"];
$contactoemail = $row["email"];
$contactoid = $row["contacto_id"];

//Add info to data base
mysqli_query($conexion, "INSERT INTO tbl_historial (clienteid, nombrecliente, contactoid, nombrecontacto, contactoemail, fechaenvio, horaenvio, mensaje) VALUES 
('$usuarioId', '$usuario', '$contactoid', '$contactonombre', '$contactoemail', CURRENT_DATE(), CURRENT_TIME(), '$textoEmail')");

//Finally send email
 $mail->send();
}
//Closing smtp connection
$mail->smtpClose();

header("location: index.php");
echo '<script>alert("Se ha enviado tu mensaje a todos tus contactos!")</script> ';
$_SESSION['message'] = "Se ha enviado tu mensaje a todos tus contactos!";
?>
</body>
</html>




	<!-- 
	$cliente_id = $_POST['cliente_id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    require 'conexion.php';
    mysqli_query($conexion, "INSERT INTO tbl_emails (contacto_id, id, nombre, email)  SELECT MAX(contacto_id)+1, '$cliente_id', '$nombre', '$email' FROM tbl_emails") or
    die($mysqli->error);
    echo "<script>location.href='index.php'</script>";
	 -->
