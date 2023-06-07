<?php
require('conexion/conexion.php');
$pk_edificios = $_GET['pk_edificios'];
$consulta = "SELECT * FROM edificios WHERE pk_edificios=$pk_edificios";
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
    <title>Editar Edificio</title>
</head>
<body class="body">
<form class="frm-login" action="inserciones/actualizar_edificios.php" method="POST">
        <h1 class="titulo">Editar Edificio</h1>


        <label for="Nombre" class="frm-label"> Nombre
            <input class="frm-input" name="nom_edificio" type="text" placeholder="Nombre" value="<?php echo $resultado['nom_edificio']; ?>">
            <input type="hidden" name="pk_edificios" value="<?php echo $resultado['pk_edificios']; ?>">
        </label>

        <div class="botones">
            <input type="submit" class="btn1" value="Enviar">
            <a href="lista_edificio.php" class="btn2"><p> Cancelar</p></a>
            
        </div>


</form>
</body>
</html>