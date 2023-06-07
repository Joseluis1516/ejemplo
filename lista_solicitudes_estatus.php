<?php
include("cabecera_admin.php");
require 'conexion.php';
// SELECT * FROM solicitud s INNER JOIN categorias_atencion ca ON s.fk_categoria_atencion=ca.pk_categoria_atencion INNER JOIN usuario u ON ca.pk_categoria_atencion=u.pk_usuario INNER JOIN departamentos d ON u.fk_persona=d.pk_departamentos INNER JOIN espacios es ON d.pk_departamentos=es.fk_edificios;

$result = ('SELECT s.*,e.nom_espacio,ca.nom_categoria_atencion,u.fk_persona,p.nombres,es.nom_espacio,ed.nom_edificio
FROM solicitud s 
INNER JOIN espacios e ON s.fk_espacios=e.pk_espacios
INNER JOIN categorias_atencion ca ON s.fk_categoria_atencion=ca.pk_categoria_atencion 
INNER JOIN usuario u ON s.fk_usuario=u.pk_usuario
INNER JOIN persona p ON u.fk_persona=p.pk_persona
INNER JOIN espacios es ON s.fk_espacios=es.pk_espacios
INNER JOIN edificios ed ON es.fk_edificios=ed.pk_edificios  
WHERE s.estatus=0
');

$eje = mysqli_query($conexion, $result);

// $result2 = ('SELECT nom_espacio FROM solicitud s INNER JOIN espacios e ON s.fk_espacios=e.pk_espacios;');
// $eje2 = mysqli_query($conexion, $result2);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilos.css">

    <title>Lista De Solicitudes Terminadas</title>

</head>

<body>
   
    <div class="datos" align="center">
        <h2>Lista De Solicitudes Terminadas</h2>
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
                    <th>Usuario</th>
                    <th>Espacio</th>
                    <th>Opciones</th>

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
                    <td class="styled-table td "><?php echo $row['nombres']?></td>
                    <td class="styled-table td "><?php echo $row['nom_edificio'].' - '.$row['nom_espacio']?></td>


                    <td>
                        <div style="display: flex; justify-content: space-around;">
                            <button onclick="actualizar_estatus_uno(<?php echo $row['pk_solicitud'] ?>)"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
  <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
  <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
</svg></button>
                            <!-- <form action="" method="POST">

                                <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#FB2424" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                    </svg></button>


                            </form> -->
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





    function actualizar_estatus(pk_solicitud){
        terminar = confirm('Desea terminar la solicitud')
        if (terminar) {
            location.href="./inserciones/editar_estatus.php?pk_solicitud="+pk_solicitud
        }
    }
    function eliminar() {
      if (window.confirm("Estas seguro?")) {
        document.getElementById("confirmacion").value=1
      }else{
        document.getElementById("confirmacion").value=0

      }
    }
</script>