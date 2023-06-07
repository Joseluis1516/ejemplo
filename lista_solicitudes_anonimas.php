<?php
include("cabecera_admin.php");
require 'conexion/conexion.php';

$result = ('SELECT sa.*,e.nom_espacio,ca.nom_categoria_atencion,ed.nom_edificio
FROM solicitudes_anonimas sa
INNER JOIN categorias_atencion ca ON sa.fk_categoria_atencion=ca.pk_categoria_atencion
INNER JOIN espacios e ON sa.fk_espacios=e.pk_espacios
INNER JOIN edificios ed ON e.fk_edificios=ed.pk_edificios');
$eje = mysqli_query($conexion, $result);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilos.css">

    <title>Lista De Solicitudes Anonimas</title>

</head>

<body>
   
    <div class="datos" align="center">
        <h2>Lista De Solicitudes Anonimas</h2>
        <table align="center" id="data">

            <thead>
                <tr>
                <tr>
                    <th>Fecha Solicitud</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Prioridad</th>
                    <th>Fecha Solucion</th>
                    <th>Categoria Atencion</th>
                    <th>Espacio</th>

                </tr>
                </tr>
            </thead>
                  
            <tbody>
            <?php while ($row =mysqli_fetch_array($eje)) {?>

                <tr>
                    <td class="styled-table td "><?php echo $row['f_solicitud']?></td>
                    <td class="styled-table td "><?php echo $row['descripcion']?></td>
                    <td class="styled-table td "><a href="./img/evidencias/<?php echo $row['imagen']?>" target="_blank">  <img src="./img/evidencias/<?php echo $row['imagen']?>" alt="" width="200px"></a></td>
                    <td class="styled-table td "><?php echo $row['prioridad']?></td>
                    <td class="styled-table td "><?php echo $row['f_solucion']?></td>
                    <td class="styled-table td "><?php echo $row['nom_categoria_atencion']?></td>
                    <td class="styled-table td "><?php echo $row['nom_edificio'].' - '.$row['nom_espacio']?></td>


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
    
</script>