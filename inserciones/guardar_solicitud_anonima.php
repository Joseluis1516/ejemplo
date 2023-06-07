<?php
require ('../conexion/conexion.php');


$descripcion = $_POST['descripcion'];
$imagen = $_FILES['imagen']['tmp_name'];
$nom_imagen = uniqid().$_FILES['imagen']['name'];
$prioridad = $_POST['prioridad'];
$fk_categoria_atencion = $_POST['fk_categoria_atencion'];
$fk_espacios = $_POST['fk_espacios'];

if (!move_uploaded_file($imagen, '../img/evidencias/'.$nom_imagen)) {
    echo "nose pudo mover";
    return;
}


$inser = "INSERT INTO solicitud VALUES
 (NULL,NOW(),'$descripcion','$nom_imagen','$prioridad','0000-00-00','$fk_categoria_atencion',NULL,'$fk_espacios', 1)";
$ejecutadoo = mysqli_query($conexion, $inser);


    if ($ejecutadoo ) {
    
        echo "<script>
        terminar = confirm('Su solicitud a sido enviada')
        if (terminar) {
            location.href = '../index.php'
        }
        </script>";

    }else{
        echo "<script> alert('Incorrecto');</script>";
    
    }

?>