<?php

ob_start();

require('../conexion/conexion.php');
$fecha_actual = date("d-m-Y h:i:s");


$result = ('SELECT s.*,e.nom_espacio,ca.nom_categoria_atencion,u.fk_persona,p.nombres,es.nom_espacio,ed.nom_edificio
FROM solicitud s 
LEFT JOIN espacios e ON s.fk_espacios=e.pk_espacios
LEFT JOIN categorias_atencion ca ON s.fk_categoria_atencion=ca.pk_categoria_atencion 
LEFT JOIN usuario u ON s.fk_usuario=u.pk_usuario
LEFT JOIN persona p ON u.fk_persona=p.pk_persona
LEFT JOIN espacios es ON s.fk_espacios=es.pk_espacios
LEFT JOIN edificios ed ON es.fk_edificios=ed.pk_edificios  
WHERE s.estatus=1
');

$eje = mysqli_query($conexion, $result);

$ruta = "../img/menbrete.png";
$imgHeader = "data:image/png;base64," . base64_encode(file_get_contents($ruta));
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin-top: 3cm;
            margin-bottom: 2cm;
        }
      table{
            background-color: white;
            text-align: center;
            border-collapse: collapse;
            width: 10%;
            box-shadow: 2px 9px 49px -17px rgba(0, 0, 0, 0.2);
            font-family: Arial, Helvetica, Geneva, sans-serif;
            font-size: 12px;
        }

        tbody {
            border: gray 4px solid;
            margin: 15px;
            padding: 15px;
            background: whitesmoke;
        }

        th {
            border: gray 4px solid;
            margin: 15px;
            padding: 10px;
            background: #2B8A7F;
            font-weight: 700;
            color: white;
        }

        td {
            border: gray 4px solid;
            margin: 15px;
            border-radius: 5px;
            padding: 15px;

        }
        header{
            position: fixed;
            top: -45px;
            left: -45px;
            right: -45px;
            height: 100px;
        }
        footer{
            position: fixed;
            bottom: -45px;
            left: -45px;
            right: -45px;
            height: 100px;
        }
        .break{
            page-break-before: always;
        }
        .ti{
            position: fixed;
            top: 45px;
            left: 45px;
            right: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="body">
    <header><img src="<?php echo $imgHeader?>" alt="" width="100%" height="100%"></header>

    <h3 align="center" class="ti">Reporte De Solicitudes</h3>
<table align="center" id="data">
<thead>
    <tr>
    <tr>
        <th>Fecha Solicitud</th>
        <th>Descripcion</th>
        <th>Imagen</th>
        <th>Prioridad</th>
        <th>Categoria Atencion</th>
        <th>Usuario</th>
        <th>Espacio</th>
    </tr>
    </tr>
</thead>
      
<tbody>
<?php while ($row =mysqli_fetch_array($eje)) {
    
    $ruta2 = "data:image/png;base64," . base64_encode(file_get_contents($ruta)); ?> http://<?php echo $_SERVER['HTTP_HOST']; ?>\solicitud\..\img\evidencias\;

?>

    

    <tr>http://<?php echo $_SERVER['HTTP_HOST']; ?>\solicitud\..\img\evidencias\<?php $imgHeader2?>
        <td class="styled-table td "><?php echo $row['f_solicitud']?></td>
        <td class="styled-table td "><?php echo $row['descripcion']?></td>
        <td class="styled-table td "><img  src="<?= "data:image/png;base64," . base64_encode(file_get_contents("../img/evidencias/".$row['imagen'] )); ?>" alt="" width="70px"></td>
        <td class="styled-table td "><?php echo $row['prioridad']?></td>
        <td class="styled-table td "><?php echo $row['nom_categoria_atencion']?></td>
        <td class="styled-table td "><?php echo ($row['nombres']) ? $row['nombres'] : 'Anonima' ?></td>
        <td class="styled-table td "><?php echo $row['nom_edificio'].' - '.$row['nom_espacio']?></td>
    </tr>
    <?php } ?>
</tbody>
</table>

</body>

</html>

<?php
$reporte = ob_get_clean();

require("../lib/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
$dompdf = new Dompdf();


// Habilitar el uso de imagenes
$option = $dompdf -> getOptions();
$option -> set(array('isRemoteEnabled' => true));
$dompdf -> setOptions($option);


$dompdf -> loadHtml($reporte);



// Hoja vertical
$dompdf -> setPaper('letter','portrait');


// Hoja horizontal
// $dompdf -> setPaper('A4','landscape');

// Generar el pdf
$dompdf -> render();

// Visualizar en el navegador
$dompdf -> stream("Reporte.pdf"." ".$fecha_actual, array("Attachment" => false));

?>