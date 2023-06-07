<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Inicio De Sesio</title>
</head>

<body class="body">
    <form class="frm-login" action="inserciones/validar.php" method="POST">
        <h1 class="titulo">Inicio Sesion</h1>

        <label for="email" class="frm-label"> Correo
            <input class="frm-input" name="nom_usuario" type="text" id="email" placeholder="ejemplo@ejemplo.com" autocomplete="off"  required>
        </label>

        <label for="Contraseña" class="frm-label buttonIn"> Contraseña
            <input class="frm-input" name="contrasena" type="password" placeholder="Contraseña" id="password" required autocomplete="off">
            <button type="button" onclick="mostrarContrasena()" class="button"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
  <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
  <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
</svg></button>
        </label>

        <?php   if (isset($_GET['error'])) {?>
            <h3 class="error">Correo o Contraseña es incorrecta</h3>

        <?php
    }
    ?>
        <div class="botones">
            <input type="submit" class="btn1" value="Entrar">
            <a href="index.php" class="btn2"><p> Cancelar</p></a>
        </div>


        <!-- <span>Has olvidado tu contraseña? Haz click <a href="#">aqui</a></span> -->

    </form>
</body>
</html>
<style>
   .buttonIn {
    position: relative;
}

 .button {
    position: absolute;
    top: 0;
    border-radius: 5px;
    right: 0px;
    z-index: 2;
    border: none;
    top: 23px;
    height: 30px;
    cursor: pointer;
    color: white;
    background-color:var(--primary-color);
    transform: translateX(2px);
}
</style>
<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("password");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
</script>