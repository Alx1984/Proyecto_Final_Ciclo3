<?php 

//kajdcbhlahbchsadbc

$mysqli = new mysqli("localhost","root","","emails");

if (isset($_POST['enviar']))
{
	
  $filename=$_FILES["file"]["name"];
  $info = new SplFileInfo($filename);
  $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

   if($extension == 'csv')
   {
	$filename = $_FILES['file']['tmp_name'];
	$handle = fopen($filename, "r");

   fgetcsv($handle);//salta la primera linea

	while( ($data = fgetcsv($handle, 1000, ",") ) !== FALSE )
	{  
      $sql = "SELECT email FROM tbl_emails WHERE email = '$data[2]'";
      $consulta = mysqli_query($mysqli, $sql);


      if (mysqli_num_rows($consulta)>0) {
         $q1 = "UPDATE tbl_emails SET id = '$data[0]', nombre = '$data[1]', contacto_id = '$data[3]' WHERE contacto_id = '$data[2]'";
      }else {
         $q = "INSERT INTO tbl_emails (id, nombre, email, contacto_id) VALUES (
            '$data[0]', 
            '$data[1]',
            '$data[2]',
            '$data[3]'
         )";
      }


	   
	$mysqli->query($q);
   }
   

      fclose($handle);
   }
   
   header('Location: dashboard.php');
}



?>