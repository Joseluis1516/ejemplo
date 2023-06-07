<?php
include("cabecera_trabajador.php");
require '../conexion/conexion.php';

$result = ('SELECT pk_solicitud, TIMESTAMPDIFF(DAY,`f_solicitud` , curdate()) AS dias_transcurridos,f_solicitud,prioridad
FROM solicitud s
WHERE s.estatus=1 and TIMESTAMPDIFF(DAY,`f_solicitud` , curdate()) >=4
');

$eje = mysqli_query($conexion, $result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/estilos.css">

    <title>Alertas</title>

</head>

<body>

    <div class="datos" align="center">
        <h2></h2>
        <table align="center" id="data">

            <thead>
                <tr>
                <tr>
                    <th>Alerta</th>
                    <th>Fecha Solicitud</th>
                    <th>Mensaje</th>
                    <th></th>
                </tr>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($eje)) { 
                    switch($row['prioridad']){
                        case('Urgente'):
                            if($row['dias_transcurridos']>=4){
                                $alerta="URGENTE";
                                $mensaje="Tiene ".$row['dias_transcurridos']." días sin ser atendida";
                            }
                            break;
                        case('Importante'):
                            if($row['dias_transcurridos']>=8){
                                $alerta="URGENTE";
                                $mensaje="Tiene ".$row['dias_transcurridos']." días sin ser atendida";
                            }
                            break;
                        case('No Importante'):
                            if($row['dias_transcurridos']>=16){
                                $alerta="URGENTE";
                                $mensaje="Tiene ".$row['dias_transcurridos']." días sin ser atendida";
                            }
                            break;
                    }
                    if(!$mensaje){
                        continue;
                    }
                    ?>

                    <tr>
                        <td class="styled-table td "><?php echo $row['prioridad'] ?></td>
                        <td class="styled-table td "><?php echo $row['f_solicitud'] ?></td>
                        <td class="styled-table td "><?php echo $mensaje ?></td>
                        <td>
                            <div style="display: flex; justify-content: space-around;">
                               <a href="principal_trabajador.php?solicitud=<?php echo $row['pk_solicitud']?>"><button>Ver</button></a>
                              
                            </div>
                        </td>
                    </tr>
                <?php } ?>

                <tr class="noSearch hide">
                    <td colspan="10"></td>
                </tr>
            </tbody>

        </table><br><br>
    </div>
</body>

</html>





<!-- buscador  -->

<script language="javascript">
    function doSearch() {
        const tableReg = document.getElementById('data');
        const searchText = document.getElementById('searchTerm').value.toLowerCase();
        let total = 0;

        // Recorremos todas las filas con contenido de la tabla
        for (let i = 1; i < tableReg.rows.length; i++) {
            // Si el td tiene la clase "noSearch" no se busca en su cntenido
            if (tableReg.rows[i].classList.contains("noSearch")) {
                continue;
            }

            let found = false;
            const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
            // Recorremos todas las celdas
            for (let j = 0; j < cellsOfRow.length && !found; j++) {
                const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                // Buscamos el texto en el contenido de la celda
                if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
                    found = true;
                    total++;
                }
            }
            if (found) {
                tableReg.rows[i].style.display = '';
            } else {
                // si no ha encontrado ninguna coincidencia, esconde la
                // fila de la tabla
                tableReg.rows[i].style.display = 'none';
            }
        }

        // mostramos las coincidencias
        const lastTR = tableReg.rows[tableReg.rows.length - 1];
        const td = lastTR.querySelector("td");
        lastTR.classList.remove("hide", "red");
        if (searchText == "") {
            lastTR.classList.add("hide");
        } else if (total) {
            td.innerHTML = "Se encontraron " + total + " resultados" + ((total > 1) ? "" : "");
        } else {
            lastTR.classList.add("red");
            td.innerHTML = "No se encontraron resultados";
        }
    }


    function actualizar_estatus(pk_solicitud) {
        terminar = confirm('Desea terminar la solicitud')
        if (terminar) {
            location.href = "./inserciones/editar_estatus.php?pk_solicitud=" + pk_solicitud
        }
    }
</script>