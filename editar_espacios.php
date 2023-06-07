<?php
require('conexion/conexion.php');
$pk_espacios = $_GET['pk_espacios'];
$consulta = "SELECT * FROM espacios WHERE pk_espacios=$pk_espacios";
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
    <title>Editar Espacios</title>
</head>
<body class="body">
<form class="frm-login" action="inserciones/actualizar_espacios.php" method="POST">
        <h1 class="titulo">Editar Espacios</h1>


        <label for="Nombre" class="frm-label"> Nombre
            <input class="frm-input" name="nom_espacio" type="text" placeholder="Nombre" value="<?php echo $resultado['nom_espacio']; ?>">
            <input type="hidden" name="pk_espacios" value="<?php echo $resultado['pk_espacios']; ?>">
        </label>

        <div class="botones">
            <input type="submit" class="btn1" value="Enviar">
            <a href="lista_espacios.php" class="btn2"><p> Cancelar</p></a>
            
        </div>


</form>
</body>
</html>