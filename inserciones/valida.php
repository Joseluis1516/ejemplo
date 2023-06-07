<?php

require('../conexion.php');

$bd=new Conexion();
$conexion=$bd->conectar();


$usuario = $_POST['nom_usuario'];
$pass = $_POST['contrasena'];

$consulta="SELECT * FROM usuario WHERE usuario=?";

$resultado=$conexion->prepare($consulta);
$resultado->bindParam(1,$usuario);
$resultado->execute();

$todo=$resultado->fetch();

if ($resultado->rowCount()>0) {
    if (password_verify($pass,$todo['pass'])) {
        switch($datos['fk_roles']){
            case 1;
                echo 'Eres administrador';
                break;
            case 2;
                echo 'Eres común prro';
                break;
        }

        echo "<h1>Correcta</h1>";

    }else{
        echo "Incorrecta";
    }
}else{
    echo "No existe";
}

?>