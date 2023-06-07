<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Document</title>
</head>
<body class="body">
<form class="frm-login" action="../inserciones/guardar_categoria_atencion.php" method="POST">
        <h1 class="titulo">Registra una categoria de atencion</h1>


        <label for="Nombre" class="frm-label"> Nombre
            <input class="frm-input" name="nom_categoria_atencion" type="text" placeholder="Nombre" required>
        </label>

        <div class="botones">
            <input type="submit" class="btn1" value="Enviar">
            <a href="principal.php" class="btn2"><p> Cancelar</p></a>

        </div>




</form>
</body>
</html>