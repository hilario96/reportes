<?php
$nombre = $_POST['nombre'];
$comentario = $_POST['comentario'];
$conn = mysqli_connect ('localhost','root','','reportes');

$nombre = mysqli_real_scape_string($conn, $nombre);
$nombre = mysqli_real_scape_string($conn, $comentario);
$resultado = mysqli_query($conn,'INSERT INTO comentarios (nombre,comentario)values("'. $nombre .' "," '. $comentario .'")');
if ($resultado)
   echo('comentario enviado con exito');
else
   echo('Error inentando enviar el comentario');
   mysqli_close($conn);
?>