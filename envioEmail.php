
<?php
require 'conexion.php';
session_start();

$usuarioId = $_SESSION['usuarioId'];
$usuario = $_SESSION['usuario'];
$textoEmail = $_POST['textoEmail'];
$nivel = $_SESSION['nivel'];


if ($nivel == 'admin') {
	$query = "SELECT email, nombre, contacto_id FROM tbl_emails";
	$result = mysqli_query($conexion, $query);
	$numrows = mysqli_num_rows($result);
}else {
	$query = "SELECT email, nombre, contacto_id FROM tbl_emails WHERE id = '$usuarioId'";
	$result = mysqli_query($conexion, $query);
	$numrows = mysqli_num_rows($result);
}


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
echo '<script>alert("Su mensaje fue enviado a todos los destinatarios con exito!")</script> ';	
echo "<script>location.href='dashboard.php'</script>";
?>