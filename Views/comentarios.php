<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/bootstrap.min.css">
</head>

<body class="bg-warning">
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-4 m-auto">
                <div class="card mt-5">
                 <div class="card-header bg-primary text-center">
                    <strong class="text-white">Iniciar Sesión</strong><br>
                    <img class="img-thumbnail" src="<?php echo base_url(); ?>/Assets/img/logo.jpg" width="100">
                    </div>
                    <div class="card-body">
                    <?php if (isset($_GET['msg'])) { ?>
                     <div class="alert alert-danger" role="alert">
                     <strong>Usuario o contraseña Incorrecta</strong>
                     </div>
                    <?php } ?>
                      <form action="<?php echo base_url(); ?>Usuarios/login" method="post" autocomplete="off">
                         <div class="form-group">
                         <strong class="text-primary">Usuario</strong>
                         <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                         </div>
                         <div class="form-group">
                         <strong class="text-primary">Contraseña</strong>
                         <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                         </div>
                         <button class="btn btn-primary btn-block" type="submit">Iniciar</button>
                      </form> 
                </div> 
             </div>
         </div>
      </div>
     </div>
                    </br></br>
    <div>
        <div>
          <div class="row justify-content-center">
                <div class="col-11">
                    <h2> Deja tu Comentario</h2>
                   
                </div>
                    </br>
                <div class="col-11-text-center"> 
                
               <form id="comentarios" action="enviarcomentario.php" method="post">
                    <h3>nombre<h3>
                      <input type="text"name="nombre"id="nombre" placeholder="escribe aqui tu nombre">
                    <h3>Comentario</h3>
                    <textarea name="comentario" id="comentario"placeholder="Escribe tu comentario"></textarea>
                    </br></br>
                      <input id="enviar" type="button" value="enviar comentario">
                </form>
                </div>
          </div>  

        </div>
    </div>
</body>
<script lenguaje="javascript">
$("#enviar").click (function() {
    var nombre = $('#nombre')val();
    var comentario = $('#comentarios')val();
    if (nombre=="")
    {
        alert ('Debe escribir un nombre');
        return;
    }
    if (comentario=="")
    {
       alert ('Debe escribir un comentario');
       return;
    }
    $('#comentarios').subnit();
});
</script>
</html>