<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Registro De Un Departamento</title>
</head>
<body class="body">
<form class="frm-login" action="inserciones/guardar_departamento.php" method="POST">
        <h1 class="titulo">Registra un Departamento</h1>


        <label for="Nombre" class="frm-label"> Nombre
            <input class="frm-input" name="nombre_departamento" type="text" placeholder="Nombre" required>
        </label>

        <!-- <label for="" class="frm-label"> Estatus
            <select name="" id="">
                <option value="">1</option>
                <option value="">0</option>
            </select>
            <input class="frm-input" name="estatus" type="text" placeholder="" maxlength="1" >
        </label> -->

        <div class="botones">
            <input type="submit" class="btn1" value="Enviar">
            <a href="principal.php" class="btn2"><p> Cancelar</p></a>

        </div>




</form>
</body>
</html>