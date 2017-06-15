<?php

$to="tommynaquiche@hotmail.com";
$subject="Contacto desde el sitio web tuagencia.com.ve";
//recuperando datos ingresados por el usuario
$message= "Detalles del formulario de contacto:<br>";
$message .= "Nombre: " . $_POST["name"]. "<br>";
$message .= "E-mail: " . $_POST["email"]. "<br>";
$message .=  "Telefono: " . $_POST["phone"]. "<br>";
$message .= "Asunto: " . $_POST["subject"]. "<br>";
$message .= "Mensaje: " . $_POST["message"]. "<br>";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$bool = mail($to,$subject,$message,$headers);

if($bool)
{
    echo 
	'<script languaje="javascript">alert("Mensaje enviado, estaremos atendiendo su solicitud a la brevedad posible");
	location.href = "contacto.html"
	</script>';			
}
else
{
    echo 
	'<script languaje="javascript">alert("Mensaje no ha sido enviado");
	location.href = "contacto.html"
	</script>';	
}



?>