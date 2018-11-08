<!DOCTYPE html>
<html>
<head>    
    <title>ENVIAR UN FORMULARIO USANDO JAVASCRIPT CON POST PHP </title>
<meta charset="UTF-8">
</head>
<body>
        
      <div id="login">        

<input id="loginemail" type="text"  placeholder="Escribir email" name="email" required="">   
<input id="loginpassword" type="text"  placeholder="Escribir contraseña" name="password" required="">
      <span >
          <button   class="btn-block btn btn-danger " type="button" onclick="loadLog()">Enviar</button>
      </span>

     </div>
             
  


<script>


function loadLog() {
    var nombre= document.getElementById('loginemail').value;
var clave= document.getElementById('loginpassword').value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("login").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "../pruebas/processpostconajax.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("email="+nombre+"&password="+clave+"");
}
</script>
            
        
    </body>
</html>