<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cabecera</title>
</head>

<body style="margin: 0">

    <!-- {{-- cabecera --}} -->
    <nav class="navbar bg-light">
        <div class="img">
            <img src="img/logo.png" width="450" height="100">
            <form action="inserciones/cerrar_sesion.php" class="salir">
                <div >
                    <input type="submit" value="Cerrar Sesion" id="cerrar">

                </div>
            </form>
        </div>
        <br>
        <div class="container-fluid" id="cabecera">

            <a value="#" href="principal_admin.php" style="text-decoration: none; color:#000;"><button class="submit">Principal</button></a>
            <a value="#" href="lista_solicitudes.php" style="text-decoration: none; color:#000;"></a>
            <a value="#" href="registro_espacios.php" style="text-decoration: none; color :#000;"> <button class="submit">Registro de Espacios</button></a>
            <a value="#" href="registro_edificios.php" style="text-decoration: none; color :#000;"> <button class="submit">Registro de Edificio</button></a>
            <a value="#" href="registro_persona.php" style="text-decoration: none; color :#000;"> <button class="submit">Registro de Persona</button></a>
            <a value="#" href="registro_solicitud.php" style="text-decoration: none; color :#000;"> <button class="submit">Registro de Solicitud</button></a>
            <a value="#" href="registro_categoria_atencion.php" style="text-decoration: none; color :#000;"> <button class="submit">Registro de Categoria Atencion</button></a>
            <a value="#" href="grafica.php" style="text-decoration: none; color :#000;"> <button class="submit">Grafica</button></a>
            <a value="#" href="inserciones/reporte.php" style="text-decoration: none; color :#000;"> <button class="submit" id="reporte">Reporte</button></a>
            <div class="dropdown">
                <button class="submit">Listas</button>
                <div class="dropdown-content ">
                    <a href="lista_solicitudes.php" style="color:#000">Lista de Solicitud</a>
                    <a href="lista_solicitudes_anonimas.php" style="color:#000">Lista de Solicitud Anonimas</a>
                    <a href="lista_categoria_atencion.php" style="color:#000">Lista Categoria Atencion</a>
                    <a href="lista_edificio.php" style="color:#000">Lista de Edificios</a>
                    <a href="lista_departamentos.php" style="color:#000">Lista de Departamenos</a>
                    <a href="lista_espacios.php" style="color:#000">Lista de Espacios</a>
                    <a href="lista_usuarios.php" style="color:#000">Lista de Usuarios</a>
                </div>
            </div>

            <!-- <form action="inserciones/cerrar_sesion.php">
                <input type="submit" value="Cerrar Sesion" class="submit" id="cerrar">
            </form> -->

            <input type="text" placeholder="Buscar" id="searchTerm" onkeyup="doSearch()">


        </div>
    </nav>
    <br><br>

</body>

</html>


<style>
    .salir{
        display: flex;
        justify-content: end;
        margin-top: -70px;
        
    }
    body {
        font-family: roboto;
    }
    #reporte:hover{
        background-color: #CFF9B2;
    }
    #cerrar {
        color: #6D271C;
        font-size: 20px;
        width: 150px;
    }
    #cerrar:hover{
        background-color: #fd989a;
    }

    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 1em;
        font-family: sans-serif;
        min-width: 10px;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
        background-color: #45a74a;
        color: #ffffff;
        text-align: middle;
    }

    .styled-table th,
    .styled-table td {
        text-align: center;
        padding: 5px 0px;
        white-space: nowrap;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    .container {
        border-radius: 0%;
        background-color: #ffffff;
    }

    .in {
        border-radius: 1%;
        margin-left: 8%;
    }


    #cabecera {
        background-color: #c4e1b3;
        padding: 20px;
        border-radius: 10px;
        width: 95%;
        margin-left: 1%;
    }

    .img {
        background-color: #dedede;
        width: 97%;
        padding: 20px;
    }

    .tabla th {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 1em;
        font-family: sans-serif;
        min-width: 29px;
        padding: 5px 0px;
        white-space: nowrap;
        background-color: #EEFBE5;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
    }

    .tabla th:hover {
        background-color: #fafffc;
    }

    .submit {
        /* border-collapse: collapse;  */
        padding: 15px;
        text-align: center;
        background-color: #c4e1b3;
        border: 0px solid #000;
        border-left: 1px solid #000;
        font-size: 14px;
        font-weight: bold;
        margin: 0;
        width: 120px;
    }

    .submit:hover {
        background-color: #EEFBE5;
    }

    .datos {
        width: 100%;
        margin: 0px 20px;
    }

    /* boton de despliegue */
    .dropdown {
        background-color: #009879;
        display: inline-block;
        position: relative;
    }

    .dropdown-content {
        background-color: white;
        display: none;
        position: absolute;
        width: 130px;
        overflow: auto;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content a {
        display: block;
        color: gray;
        padding: 5px;
        text-decoration: none;
    }

    .dropdown-content a:hover {
        color: black;
        background-color: #dedede;
    }
</style>




<!-- {{-- buscador --}} -->

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
            const cellsOfRow = tableReg.rows[i].getElementsByTagName('th');
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
        const td = lastTR.querySelector("th");
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