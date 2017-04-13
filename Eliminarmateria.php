<?php
include("conexion.php");
session_start();
$ID = $_GET['id'];
$Eliminarmateria="DELETE FROM materias
                WHERE idmateria= '$ID'";
$resultado=$conexion->query($Eliminarmateria);
echo "<script>alert('Registro Eliminado Exitosamente');
            window.location='listaclases.php';
</script>";

?>