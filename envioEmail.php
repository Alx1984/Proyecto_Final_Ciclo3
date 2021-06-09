<?php

$recipients = array(
	'alxaleman@gmail.com' => 'Alex1',
	'alxaleman1984@gmail.com'=> 'Alex2',
	'melvinguzman1104@gmail.com'=> 'Melvin',
	'jatrejo081@gmail.com'=> 'Juan',
	'yansiaguirreg@gmail.com'=> 'Yansi',
	'alx-aleman@hotmail.com'=> 'Alex3',
);


//Include required PHPMailer files
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
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
	$mail->Body = "<h1>Noticia importante Grupo ITCA</h1></br><p>Este solo es un correo de prueba adicinando otro correo de HOTMAIL</p>";
//Add recipient
//$mail->addAddress($emailArray);

foreach ($recipients as $email => $name) {
	$mail->AddCC($email, $name);
}

//Finally send email
	if ( $mail->send() ) {
		echo "Correo Enviado...";
	}else{
		echo "Message could not be sent. Mailer Error: "[$mail->ErrorInfo];
	}
//Closing smtp connection
	$mail->smtpClose();
