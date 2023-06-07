<?php
session_start();

require ('../conexion/conexion.php');

$descripcion = $_POST['descripcion'];
$imagen = $_FILES['imagen']['tmp_name'];
$nom_imagen = uniqid().$_FILES['imagen']['name'];
$prioridad = $_POST['prioridad'];
$fk_categoria_atencion = $_POST['fk_categoria_atencion'];
$pk_usuario=$_SESSION['pk_usuario'];
$fk_espacios = $_POST['fk_espacios'];
// print_r($_SESSION);

if (!move_uploaded_file($imagen, '../img/evidencias/'.$nom_imagen)) {
    echo "nose pudo mover";
    return;
}

if (isset($_POST['mandar_solicitud'])) {
    // if (isset($_POST['che1']) && $_POST['che1'] == '1') {

    //     $insertar_anonimo = "INSERT INTO solicitudes_anonimas VALUES (NULL,NOW(),'$descripcion','$nom_imagen','$prioridad','0000-00-00','$fk_categoria_atencion','$fk_espacios', 1)";
    //     $ejecutado_solicitud_anonimo = mysqli_query($conexion, $insertar_anonimo);

    //     if($ejecutado_solicitud_anonimo){
    //         echo 'Todo bien anonimo';
    //     } else {
    //         echo 'Todo mal anonimo';
    //     }
    // } else  {
        $insertar_solicitud = "INSERT INTO solicitud VALUES (NULL, NOW(),'$descripcion','$nom_imagen','$prioridad','0000-00-00','$fk_categoria_atencion','$pk_usuario','$fk_espacios', 1)";
        $ejecutado_solicitud = mysqli_query($conexion, $insertar_solicitud);

        if($ejecutado_solicitud){
            echo 'Todo bien';
            header("location:../comun/principal.php");
        } else {
            echo "<script> alert('Todo Mal');</script>";
            // header("location:../registro_solicitud.php");

            // echo $insertar_solicitud;
        }
    } else {
        echo "error";
    }
// }

?>