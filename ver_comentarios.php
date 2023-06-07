<?php
require 'conexion/conexion.php';
$pk_solicitud = $_POST['pk_solicitud'];

$result = ("SELECT c.*,u.nom_usuario
FROM  comentarios c
left join usuario u on c.fk_usuario=u.pk_usuario
WHERE c.fk_solicitud='$pk_solicitud'");

$eje = mysqli_query($conexion, $result);

echo "<input type='hidden' value='$pk_solicitud' id='modal_solicitud'>";

while ($row =mysqli_fetch_array($eje)){
    echo "
    <tr>
        <td>".$row['nom_usuario']."</td>
        <td>".$row['comentario']."</td>
        <td>".$row['fecha']."</td>
    </tr>
    ";
}

?>
