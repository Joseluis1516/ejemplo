<?php
session_start();
if (isset($_SESSION['nom_usuario'])) {
    $usuario3 = $_SESSION['nom_usuario'];
    // echo $_SESSION['nom_usuario'];
} else {
    header("location: ../inicio_sesion.php");
}
include("cabecera_trabajador.php");
require '../conexion/conexion.php';

date_default_timezone_set('America/Mazatlan');
$fecha = date('Y-m-d');
$solicitud=isset($_GET['solicitud']) ? $_GET['solicitud']:'';
$where = "";
if ($solicitud) {
    $where = "AND pk_solicitud=$solicitud";
}
$result = ("SELECT s.*,e.nom_espacio,ca.nom_categoria_atencion,
u.fk_persona,p.nombres,es.nom_espacio,ed.nom_edificio,c.comentario
FROM solicitud s 
LEFT JOIN espacios e ON s.fk_espacios=e.pk_espacios
LEFT JOIN categorias_atencion ca ON s.fk_categoria_atencion=ca.pk_categoria_atencion 
LEFT JOIN usuario u ON s.fk_usuario=u.pk_usuario
LEFT JOIN persona p ON u.fk_persona=p.pk_persona
LEFT JOIN espacios es ON s.fk_espacios=es.pk_espacios
LEFT JOIN edificios ed ON es.fk_edificios=ed.pk_edificios 
LEFT JOIN comentarios c ON s.pk_solicitud=c.pk_comentarios WHERE  s.estatus=1
$where
GROUP BY pk_solicitud DESC");
$eje = mysqli_query($conexion, $result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../jquery-3.6.3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Principal</title>

</head>

<body>

    <div class="datos" align="center">
        <h2</h2>
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
                    <th>Comentario</th>
                    <th>Espacio</th>
                    <th>Opciones</th>

                </tr>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($eje)) { ?>

                    <tr>
                        <td class="styled-table td "><?php echo $row['f_solicitud'] ?></td>
                        <td class="styled-table td "><?php echo $row['descripcion'] ?></td>
                        <td class="styled-table td "><a href="../img/evidencias/<?php echo $row['imagen'] ?>" target="_blank"> <img src="../img/evidencias/<?php echo $row['imagen'] ?>" alt="" width="200px"></a></td>
                        <td class="styled-table td "><?php echo $row['prioridad'] ?></td>
                        <td class="styled-table td "><?php echo $row['nom_categoria_atencion'] ?></td>
                        <td class="styled-table td "><?php echo ($row['nombres']) ? $row['nombres'] : 'Anonima' ?></td>
                        <td class="styled-table td "><button onclick="ver(<?php echo $row['pk_solicitud'] ?>)">Ver comentarios</button></td>
                        <td class="styled-table td "><?php echo $row['nom_edificio'] . ' - ' . $row['nom_espacio'] ?></td>

                        <td>
                            <div style="display: flex; justify-content: space-around;">
                                <button onclick="actualizar_estatus(<?php echo $row['pk_solicitud'] ?>,<?php echo ($row['nombres']) ? 0 : 1 ?>)"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
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
    <div id="mimodal" class="modal">

        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Comentario</th>
                    <th>Fecha</th>

                </tr>
            </thead>
            <tbody id='lista_comentarios'>

            </tbody>
        </table>
        <p><label for="">Escribe un comentario</label></p>
        <p><textarea name="" id="modal_comentario" cols="30" rows="10"></textarea></p>
        <p><button id="" onclick="enviarComentario()">Enviar</button></p>
    </div>
</body>

</html>


<!-- buscador  -->

<script language="javascript">
    function enviarComentario() {
        var comentario = $("#modal_comentario").val();
        $.ajax({
            type: "POST",
            url: "../inserciones/guardar_comentario.php",
            data: {
                'pk_solicitud': $("#modal_solicitud").val(),
                'comentario': comentario,
                'usuario': <?php echo $_SESSION['pk_usuario'] ?>
            },
            dataType: "html",
            success: function(dato) {
                $("#lista_comentarios").append("<tr><td><?php echo $_SESSION['nom_usuario'] ?></td><td>" + comentario + "</td><td></td></tr>");
                $("#modal_comentario").val('')
            }
        });
    }


    function ver(id) {
        $.ajax({
            type: "POST",
            url: "../ver_comentarios.php",
            data: {
                'pk_solicitud': id
            },
            dataType: "html",
            success: function(dato) {
                $("#lista_comentarios").html(dato);
                $('#mimodal').modal();
            }
        });
    }


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

    function actualizar_estatus(pk_solicitud, anonima) {


        // mensaje comentario

        Swal.fire({
            title: 'Esta seguro de terminar la solicitud?, agregue un comentario',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            showLoaderOnConfirm: true,
        }).then((result) => {
            comentario = '';
            if (result.value) {
                comentario = result.value;
            }

            $.ajax({
                type: "POST",
                url: "../inserciones/editar_estatus.php",
                data: {
                    'pk_solicitud': pk_solicitud,
                    'comentario': comentario,
                    'anonima': anonima

                },
                dataType: "html",
                success: function(dato) {
                    location.reload();
                }
            });
        });
    }
</script>