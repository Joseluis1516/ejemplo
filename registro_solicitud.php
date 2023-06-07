<?php
    require 'conexion/conexion.php';

    $sql = "SELECT * FROM categorias_atencion";
    $sql3 = "SELECT * FROM edificios e INNER JOIN espacios es ON e.pk_edificios=es.fk_edificios;";
    $sql4 = "SELECT * FROM departamentos";
    $resultado = mysqli_query($conexion, $sql );
    $resultado3 = mysqli_query($conexion, $sql3 );
    $resultado4 = mysqli_query($conexion, $sql4 );
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">

    <!-- select con buscador -->

    <script src="jquery-3.6.3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <title>Registro De Solicitud</title>
</head>


<body class="body">
    <form class="frm-login" action="inserciones/guardar_solicitud.php" method="post" enctype="multipart/form-data">
        <h1 class="titulo">Registro Solicitud</h1>

        <label for="Descripcion" class="frm-label"> Descripcion
<input class="frm-input" name="descripcion" type="text" placeholder="Descripcion" autocomplete="off" required>
</label>

<label for="Imagen" class="frm-label"> Imagen
            <input class="frm-input" name="imagen" type="file" placeholder="Imagen" required>
        </label>


        <label class="frm-label"> Prioridad <br>
        <select class="frm-input" name="prioridad"  required>
        <option disabled selected>Seleccionar Prioridad</option>
                <option value="Urgente">Urgente</option>
                <option value="Importante">Importante</option>
                <option value="No Importante">No Importante</option>
            </select>
        </label>


        <label class="frm-label"> Categoria Atencion  <br>
        <select class="frm-input" name="fk_categoria_atencion"  required>
        <option disabled selected>Seleccionar categoria atencion</option>
                <?php while($result = mysqli_fetch_array($resultado)){ ?>
                    <option value="<?php echo $result['pk_categoria_atencion']; ?>">
                    <?php echo $result['nom_categoria_atencion']; ?>
                </option>
                <?php
                }
                ?>
            </select>

        </label>
        
        <label  class="frm-label"> Espacios  <br>
        <select class="frm-input" name="fk_espacios" id="espacios" required>
            <option disabled selected>Seleccionar Edificio</option>
            <?php while($result = mysqli_fetch_array($resultado3)){ ?>
                <option value="<?php echo $result['pk_espacios']; ?>">
                    <?php echo $result['nom_edificio'].' - '.$result['nom_espacio']; ?>
                </option>
                <?php
                }
                ?>
            </select>
        </label>
    
        <div class="botones">
            <input type="submit" class="btn1" name="mandar_solicitud" value="Enviar">
            <a href="principal_admin.php" class="btn2"><p> Cancelar</p></a>

        </div>

    </form>




    <script>
        $('#espacios').select2();
    </script>
</body>

</html>