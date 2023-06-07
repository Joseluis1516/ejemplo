<?php
session_start();
if (isset($_SESSION['nom_usuario'])) {
    $usuario3 = $_SESSION['nom_usuario'];
    // echo $_SESSION['nom_usuario'];
} else {
    header("location: ../inicio_sesion.php");
}

include("cabecera_admin.php");
require 'conexion/conexion.php';

date_default_timezone_set('America/Mazatlan');
$fecha = date('Y-m-d');

$result = ("SELECT 
sum(if(month(f_solicitud)=1,1,0)) as enero, 
sum(if(month(f_solicitud)=2,1,0)) as febrero, 
sum(if(month(f_solicitud)=3,1,0)) as marzo, 
sum(if(month(f_solicitud)=4,1,0)) as abril, 
sum(if(month(f_solicitud)=5,1,0)) as mayo, 
sum(if(month(f_solicitud)=6,1,0)) as junio, 
sum(if(month(f_solicitud)=7,1,0)) as julio, 
sum(if(month(f_solicitud)=8,1,0)) as agosto, 
sum(if(month(f_solicitud)=9,1,0)) as septiembre, 
sum(if(month(f_solicitud)=10,1,0)) as octubre, 
sum(if(month(f_solicitud)=11,1,0)) as noviembre, 
sum(if(month(f_solicitud)=12,1,0)) as diciembre,

sum(if(month(f_solicitud)=1 and estatus=1,1,0)) as enero_activa, 
sum(if(month(f_solicitud)=2  and estatus=1,1,0)) as febrero_activa, 
sum(if(month(f_solicitud)=3  and estatus=1,1,0)) as marzo_activa, 
sum(if(month(f_solicitud)=4  and estatus=1,1,0)) as abril_activa, 
sum(if(month(f_solicitud)=5  and estatus=1,1,0)) as mayo_activa, 
sum(if(month(f_solicitud)=6  and estatus=1,1,0)) as junio_activa, 
sum(if(month(f_solicitud)=7  and estatus=1,1,0)) as julio_activa, 
sum(if(month(f_solicitud)=8  and estatus=1,1,0)) as agosto_activa, 
sum(if(month(f_solicitud)=9  and estatus=1,1,0)) as septiembre_activa, 
sum(if(month(f_solicitud)=10  and estatus=1,1,0)) as octubre_activa, 
sum(if(month(f_solicitud)=11  and estatus=1,1,0)) as noviembre_activa, 
sum(if(month(f_solicitud)=12  and estatus=1,1,0)) as diciembre_activa,

sum(if(month(f_solicitud)=1 and estatus=0,1,0)) as enero_terminada, 
sum(if(month(f_solicitud)=2  and estatus=0,1,0)) as febrero_terminada, 
sum(if(month(f_solicitud)=3  and estatus=0,1,0)) as marzo_terminada, 
sum(if(month(f_solicitud)=4  and estatus=0,1,0)) as abril_terminada, 
sum(if(month(f_solicitud)=5  and estatus=0,1,0)) as mayo_terminada, 
sum(if(month(f_solicitud)=6  and estatus=0,1,0)) as junio_terminada, 
sum(if(month(f_solicitud)=7  and estatus=0,1,0)) as julio_terminada, 
sum(if(month(f_solicitud)=8  and estatus=0,1,0)) as agosto_terminada, 
sum(if(month(f_solicitud)=9  and estatus=0,1,0)) as septiembre_terminada, 
sum(if(month(f_solicitud)=10  and estatus=0,1,0)) as octubre_terminada, 
sum(if(month(f_solicitud)=11  and estatus=0,1,0)) as noviembre_terminada, 
sum(if(month(f_solicitud)=12  and estatus=0,1,0)) as diciembre_terminada



FROM `solicitud`
;
");
$objdata = [];
$eje = mysqli_query($conexion, $result);
while ($obj = mysqli_fetch_object($eje)) {
    $objdata = [
        $obj->enero,
        $obj->febrero,
        $obj->marzo,
        $obj->abril,
        $obj->mayo,
        $obj->junio,
        $obj->julio,
        $obj->agosto,
        $obj->septiembre,
        $obj->octubre,
        $obj->noviembre,
        $obj->diciembre
    ];
    $objdata_activa = [
        $obj->enero_activa,
        $obj->febrero_activa,
        $obj->marzo_activa,
        $obj->abril_activa,
        $obj->mayo_activa,
        $obj->junio_activa,
        $obj->julio_activa,
        $obj->agosto_activa,
        $obj->septiembre_activa,
        $obj->octubre_activa,
        $obj->noviembre_activa,
        $obj->diciembre_activa
    ];
    $objdata_terminada = [
        $obj->enero_terminada,
        $obj->febrero_terminada,
        $obj->marzo_terminada,
        $obj->abril_terminada,
        $obj->mayo_terminada,
        $obj->junio_terminada,
        $obj->julio_terminada,
        $obj->agosto_terminada,
        $obj->septiembre_terminada,
        $obj->octubre_terminada,
        $obj->noviembre_terminada,
        $obj->diciembre_terminada
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Grafica</title>
</head>

<body>
    <div>
        <canvas id="myChart"></canvas>
    </div>
</body>

</html>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: '# Solicitudes',
                data: <?php echo json_encode($objdata) ?>,
                borderWidth: 1
            }, {
                label: '# Activas',
                data: <?php echo json_encode($objdata_activa) ?>,
                borderWidth: 1
            },
            {
                label: '# Terminada',
                data: <?php echo json_encode($objdata_terminada) ?>,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Solicitudes'
                }
            }
        }
    });
</script>