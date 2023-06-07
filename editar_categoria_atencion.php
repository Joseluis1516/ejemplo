<?php
require('conexion/conexion.php');
$pk_categoria_atencion = $_GET['pk_categoria_atencion'];
$consulta = "SELECT * FROM categorias_atencion WHERE pk_categoria_atencion=$pk_categoria_atencion";
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
    <title>Editar Categoria Atencion</title>
</head>
<body class="body">
<form class="frm-login" action="inserciones/actualizar_categoria_atencion.php" method="POST">
        <h1 class="titulo">Editar Categoria Atencion</h1>


        <label for="Nombre" class="frm-label"> Nombre
            <input class="frm-input" name="nom_categoria_atencion" type="text" placeholder="Nombre" value="<?php echo $resultado['nom_categoria_atencion']; ?>">
            <input type="hidden" name="pk_categoria_atencion" value="<?php echo $resultado['pk_categoria_atencion']; ?>">
        </label>

        <div class="botones">
            <input type="submit" class="btn1" value="Enviar">
            <a href="lista_categoria_atencion.php" class="btn2"><p> Cancelar</p></a>
            
        </div>


</form>
</body>
</html>