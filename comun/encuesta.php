<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css?a=0">

    <title>Encuesta</title>

</head>

<body class="body">
    <form class="frm-login" action="../inserciones/guardar_encuesta.php" method="post">
        <h1 class="titulo">Encuesta</h1>

        <label for="" class="frm-label"> ¿En cuanto tiempo se realizo la reparacion?
            <select name="pregunta1" class="frm-input">
        <option disabled selected>Seleccionar Tiempo</option>
                <option value="En el mismo dia">En el mismo dia</option>
                <option value="3 Dias">3 Dias</option>
                <option value="1 Semana">1 Semana</option>
                <option value="2 Semana">2 Semanas o Más</option>
            </select>

        </label>

        <label for="" class="frm-label"> ¿Tuvo buena calidad al realizar la reparacion? <br>
            <input class="input-hidden" type="radio"  name="pregunta2" value="mal" id="mal">
            <label for="mal"><img src="../img/1.PNG" alt="mal" class="im"></label>
            <input class="input-hidden" type="radio"  name="pregunta2" value="regular" id="regular">
            <label for="regular"><img src="../img/3.PNG" alt="regular" class="im"></label>
            <input class="input-hidden" type="radio"  name="pregunta2" value="bien" id="bien">
            <label for="bien"><img src="../img/5.PNG" alt="bien" class="im"></label>
        </label>

        <label for="" class="frm-label"> Comentario

            <input class="frm-input" name="pregunta3" type="text" >

        </label>
        <div class="botones">
            <input type="submit" class="btn1" value="Enviar">
            <a href="principal.php" class="btn2"><p> Cancelar</p></a>
            <input  name="solicitud" type="hidden" value="<?php echo $_GET['pk_solicitud']?>" >

        </div>


    </form>
</body>

</html>