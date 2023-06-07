<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>GeeksoforGeeks</h1>
    <b>Responsive clear field button</b>
    <br><br>
    <div class="buttonIn">
        <input type="password" id="enter">
        <button id="clear" onclick="mostrarContrasena()">clear</button>
    </div>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/theYouTubecode" frameborder="0" allowfullscreen></iframe>

        <embed width=”560” height=”315”> https://www.youtube.com/embed/theYouTubecode</embed>


</body>

</html>

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
<!-- 
<style>
    h1 {
        color: green;
    }
     
    .buttonIn {
        width: 300px;
        position: relative;
    }
     
    input {
        margin: 0px;
        padding: 0px;
        width: 100%;
        outline: none;
        height: 30px;
        border-radius: 5px;
    }
     
    button {
        position: absolute;
        top: 0;
        border-radius: 5px;
        right: 0px;
        z-index: 2;
        border: none;
        top: 2px;
        height: 30px;
        cursor: pointer;
        color: white;
        background-color: #1e90ff;
        transform: translateX(2px);
    }
     
</style> -->
