<?php
    require '../conexion/conexion.php';

    $sql = "SELECT * FROM edificios";
    $resultado = mysqli_query($conexion, $sql);
?>

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
<form class="frm-login" action="../inserciones/guardar_espacios.php" method="POST">
        <h1 class="titulo">Registra un Espacios</h1>

        <label for="Nombre" class="frm-label"> Nombre
            <input class="frm-input" name="nom_edificio" type="text" placeholder="Nombre" required>
        </label>
        <label for="Edificio" class="frm-label"> Edificio
        <select class="frm-input" name="fk_edificios" required>
        <option disabled selected>Seleccionar Edificio</option>
                <?php while($result = mysqli_fetch_array($resultado)){ ?>
                    <option value="<?php echo $result['pk_edificios']; ?>">
                    <?php echo $result['nom_edificio']; ?>
                </option>
                <?php
                }
                ?>
        </select>

    </label>

        <div class="botones">
            <input type="submit" class="btn1" value="Enviar">
            <a href="principal.php" class="btn2"><p> Cancelar</p></a>

        </div>

</form>
</body>
</html>