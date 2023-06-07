<?php
session_start();
if (isset($_SESSION['nom_usuario'])) {
    $usuario3 = $_SESSION['nom_usuario'];
    // echo $_SESSION['nom_usuario'];
} else {
    header("location: ../inicio_sesion.php");
}
include("cabecera.php");
require '../conexion/conexion.php';
 

date_default_timezone_set('America/Mazatlan');
$fecha = date('Y-m-d');

$result = ("SELECT s.*,e.nom_espacio,ca.nom_categoria_atencion,u.fk_persona,p.nombres,es.nom_espacio,ed.nom_edificio
FROM solicitud s 
LEFT JOIN espacios e ON s.fk_espacios=e.pk_espacios
LEFT JOIN categorias_atencion ca ON s.fk_categoria_atencion=ca.pk_categoria_atencion 
LEFT JOIN usuario u ON s.fk_usuario=u.pk_usuario
LEFT JOIN persona p ON u.fk_persona=p.pk_persona
LEFT JOIN espacios es ON s.fk_espacios=es.pk_espacios
LEFT JOIN edificios ed ON es.fk_edificios=ed.pk_edificios WHERE u.nom_usuario ='$usuario3' AND s.estatus=1 GROUP BY pk_solicitud DESC");
$eje = mysqli_query($conexion, $result);
// echo $_SESSION['pk_usuario'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Principal</title>

</head>

<body>

    <div class="datos" align="center">
        <h2>Solicitudes Pendientes</h2>
        <table align="center" id="data">

            <thead>
                <tr>
                <tr>
                    <th>Fecha Solicitud</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Prioridad</th>
                    <!-- <th>Comentario</th> -->
                    <th>Categoria Atencion</th>
                    <th>Usuario</th>
                    <th>Espacio</th>

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
                        <!-- <td class="styled-table td "><button onclick="ver(<?php echo $row['pk_solicitud'] ?>)">Ver comentarios</button></td> -->
                        <td class="styled-table td "><?php echo $row['nom_categoria_atencion'] ?></td>
                        <td class="styled-table td "><?php echo $row['nombres'] ?></td>
                        <td class="styled-table td "><?php echo $row['nom_edificio'] . ' - ' . $row['nom_espacio'] ?></td>
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
<p><textarea name="" id="modal_comentario"  cols="30" rows="10"></textarea></p>
<p><button id="" onclick="enviarComentario()">Enviar</button></p>

</div>
</body>

</html>


<!-- buscador  -->
<style>
    .text {
        background-color: white;
        width: 30%;
        border-radius: 10px;
        padding: 3px;
        margin-bottom: 8px;
    }
</style>
<script language="javascript">

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

    function enviarComentario(){
        var comentario=$("#modal_comentario").val();
        $.ajax({
            type: "POST",
            url: "../inserciones/guardar_comentario.php",
            data: {
                'pk_solicitud': $("#modal_solicitud").val(),
                'comentario':comentario,
                'usuario':<?php echo $_SESSION['pk_usuario']?>
            },
            dataType: "html",
            success: function(dato) {
                $("#lista_comentarios").append("<tr><td><?php echo $_SESSION['nom_usuario']?></td><td>"+comentario+"</td><td></td></tr>");
                $("#modal_comentario").val('')
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
</script>