<?php
include("cabecera_admin.php");
require 'conexion/conexion.php';
// SELECT * FROM solicitud s INNER JOIN categorias_atencion ca ON s.fk_categoria_atencion=ca.pk_categoria_atencion INNER JOIN usuario u ON ca.pk_categoria_atencion=u.pk_usuario INNER JOIN departamentos d ON u.fk_persona=d.pk_departamentos INNER JOIN espacios es ON d.pk_departamentos=es.fk_edificios;

$result = ('SELECT * FROM departamentos WHERE estatus=1');

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
    <script src="jquery-3.6.3.js"></script>


    <title>Lista De Departamentos</title>

</head>

<body>

    <div class="datos" align="center">
        <h2>Lista De Departamentos</h2>
        <table align="center" id="data">

            <thead>
                <tr>
                <tr>
                    <th>Nombre</th>
                    <th>Opciones</th>

                </tr>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($eje)) { ?>

                    <tr>
                        <td class="styled-table td "><?php echo $row['nombre_departamento'] ?></td>

                        <td>
                            <div style="display: flex; justify-content: space-around;">
                                <button onclick="editar(<?php echo $row['pk_departamentos'] ?>)"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></button>
                               <button  onclick="eliminar(<?php echo $row['pk_departamentos'] ?>)"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="#FB2424" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg></button>

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





    function editar(pk_departamentos) {
        terminar = confirm('¿Desea editar el departamento?')
        if (terminar) {
            location.href = "editar_departamento.php?pk_departamentos=" + pk_departamentos
        }
    }

    function eliminar(id) {
        if (window.confirm("Estas seguro?")) {
            $.ajax({
                type: "POST",
                url: "inserciones/eliminar_departamento.php",
                data: {
                    'pk_departamentos': id
                },
                dataType: "html",
                success: function(dato) {
                    location.reload();
                }
            });
        } else {
           alert('no se pudo eliminar');
        }
    }
</script>