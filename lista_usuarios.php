<?php
include("cabecera_admin.php");
require 'conexion/conexion.php';

$result = "CALL persona_usuario()";

$eje = mysqli_query($conexion, $result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="jquery-3.6.3.js"></script>

    <title>Lista De Usuarios</title>

</head>

<body>

    <div class="datos" align="center">
        <h2>Listado De Usuarios</h2>
        <table align="center" id="data">

            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Usuario</th>
                    <th>Tipo de usuario</th>
                    <th>Opciones</th>

                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($eje)) { ?>

                    <tr>
                        <td class="styled-table td "><?php echo $row['nombres'] ?> <?php echo $row['apaterno'] ?> <?php echo $row['amaterno'] ?></td>
                        <td class="styled-table td "><?php echo $row['nom_usuario'] ?></td>
                        <td class="styled-table td "><?php echo $row['nom_tipo_usuario'] ?></td>
                        <td>
                            <div style="display: flex; justify-content: space-around;">
                                <button onclick="eliminar('<?php echo $row['pk_usuario'] ?>')"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#FB2424" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                    </svg></button>
                                <input type="hidden" name="confirmacion" id="confirmacion">
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

    function eliminar(id) {
        if (window.confirm("Estas seguro?")) {
            $.ajax({
                type: "POST",
                url: "inserciones/eliminar_usuario.php",
                data: {
                    'pk_usuario': id
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