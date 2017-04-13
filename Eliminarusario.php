<?php
include("conexion.php");
session_start();
$ID = $_GET['id'];

/*$sql = "DELETE u.*, a.*, m.* FROM alumnos AS a
            INNER JOIN usuarios AS u ON a.IdAlumnos = u.id_alumno
            INNER JOIN materias AS m ON u.idusuarios = m.idusuario
            WHERE u.idusuarios= '$ID'  ";


$resultado=$conexion->query($sql);

$sql1 = "DELETE u.*, a.* FROM alumnos AS a
            INNER JOIN usuarios AS u ON a.IdAlumnos = u.id_alumno
         WHERE u.idusuarios= '$ID'  ";
$resultado1=$conexion->query($sql1);

echo "<script>alert('Usuario Eliminado Exitosamente');
            window.location='listausuarios.php';
</script>"; */
echo "<script>alert('No titenes permiso para eliminar usuarios');
            window.location='listausuarios.php';
</script>";
?>