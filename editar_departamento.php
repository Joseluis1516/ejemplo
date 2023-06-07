<?php
require('conexion/conexion.php');
$pk_departamentos = $_GET['pk_departamentos'];
$consulta = "SELECT * FROM departamentos WHERE pk_departamentos=$pk_departamentos";
$query=mysqli_query($conexion, $consulta);
$resultado=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Editar Departamentos</title>
</head>
<body class="body">
<form class="frm-login" action="inserciones/actualizar_departamentos.php" method="POST">
        <h1 class="titulo">Editar Departamentos</h1>


        <label for="Nombre" class="frm-label"> Nombre
            <input class="frm-input" name="nombre_departamento" type="text" placeholder="Nombre" value="<?php echo $resultado['nombre_departamento']; ?>">
            <input type="hidden" name="pk_departamentos" value="<?php echo $resultado['pk_departamentos']; ?>">
        </label>

        <div class="botones">
            <input type="submit" class="btn1" value="Enviar">
            <a href="lista_departamentos.php" class="btn2"><p> Cancelar</p></a>
            
        </div>


</form>
</body>
</html>