<?php
  //realizar la conexion desde otro archivo 
include 'controlador.php';
date_default_timezone_set('America/Caracas');
session_start();

  if(!isset($_SESSION["email"]) and !isset($_SESSION["Nivel"])){ //Comprobacion de inicio de session

    header('Location:login.php');
    exit; 
  }

  //recibir el boton  
  $boton=$_POST["boton"];
  
  $Buscar = $_POST["Buscar"];
  $id_usuario = $_POST["id_usuario"];
  $Nombre= $_POST['Nombre'];
  $Apellido=$_POST["Apellido"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];
  $Nivel = $_POST["Nivel"];

// Almacenar los datos
if($boton=="Guardar"){

  if ($password == $confirm_password){

  $sql = "insert into usuario (nombre,apellido,email,password,Nivel) values ('$Nombre', '$Apellido', '$email', '$password','$Nivel')";
      
            if(mysql_query($sql)){
              
                  echo '<script>alert("Datos Guardados");</script>';

            }else{
                  echo '<script>alert("Datos NO Guardados");</script>';
            }

    }else{
        echo '<script>alert("Password no conincide");</script>';
    }
}


// Buscar los datos
if($boton=="Buscar"){
  $sql="select * from usuario where nombre like '$Buscar%' ";
  $busqueda=mysql_query($sql);
  if( $row=mysql_fetch_array($busqueda)){

    $id_usuario = $row['id_usuario'];
    $Nombre = $row['nombre'];
    $Apellido = $row['apellido'];
    $Email = $row['email'];
    $Nivel = $row['Nivel'];



    }else{
    echo '<script>alert("Registro NO EXISTE en el Sistema");</script>';
  }
  
}

if($boton=="Limpiar"){
echo "<script>window.location='NuevoUsuario.php'</script>";
}

// Eliminar los datos
if($boton=="Eliminar"){

  if($id_usuario!=""){
    $sql="delete from usuario where id_usuario ='$id_usuario'";
    if (mysql_query($sql)){

        echo '<script>alert("Datos Eliminados");</script>';
    }
  }else{

    echo '<script>alert("Para poder ELIMINAR debe Realizar una busqueda");</script>';

  }
  
}

// Modificar los datos
if($boton=="Modificar"){

         $sql="update usuario set nombre='$nombre', email='$email', password='$password',Nivel='$Nivel' where Nombre ='$idUsuario'";

            if(mysql_query($sql)){

                    echo '<script>alert("Datos Modificados");</script>';

              }else{

                echo '<script>alert("No se puede Modificar");</script>';
              }


 }
  

   
?>
<!DOCTYPE html>
<html>
<head>
  <title>UCAI</title>
  <!--ICONO-->
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/logo.png" />
  <!--Bootstrap -->
    <link href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <!--Fuente Glyphycon -->
    <link href="bootstrap-4.0.0-alpha.6-dist/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!--Alertfly-->
    <link href="bootstrap-4.0.0-alpha.6-dist/alertifyjs/css/alertify.min.css" rel="stylesheet" type="text/css">
  <!--Hoja de Estilo-->
    <link href="assets/css/main.css" rel="stylesheet" type="text/css">

    <!--Javascript-->
    <script src="bootstrap-4.0.0-alpha.6-dist/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-4.0.0-alpha.6-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-4.0.0-alpha.6-dist/alertifyjs/alertify.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <!--Javascript-->

    <!--FullCalendar-->
    <link rel='stylesheet' href="fullcalendar-3.9.0/fullcalendar.min.css"/>
    <script src="fullcalendar-3.9.0/lib/moment.min.js"></script>
    <script src="fullcalendar-3.9.0/fullcalendar.min.js"></script>
    <script src='fullcalendar-3.9.0/locale-all.js'></script>
    <!--End FullCalendar-->

    <!--Date Time Piker-->
    <link rel="stylesheet" href="bootstrap4-datetimepicker-master/css/bootstrap-datetimepicker.min.css" />
    <script src="bootstrap4-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
    <!--End Date Time Piker-->

        <!--Validation-->
    <script src='jquery-validation-1.17.0/dist/jquery.validate.min.js'></script>
    <script src='jquery-validation-1.17.0/dist/additional-methods.min.js'></script>
    <!-- End Validation-->
<body>

  <div class="main-wrapper-first">
     <!-- Barra Superior -->
      <header>
        <div class="container">
          <div class="header-wrap">
            <div class="header-top">
                <nav class="navbar navbar-toggleable-md navbar-light">
                  <a href="index.php">Inicio</a>
                <?php 
                  if (!$_SESSION['Nivel']==1) {
                ?>
                  <a href="login.php">Login</a>
                <?php
                  }
                ?>
                <?php 
                  if ($_SESSION['Nivel']==1) {
                ?>
                <li class="dropdown" style="list-style:none">
                      <a href="#" class="menubar" class="dropdown-toggle" data-toggle="dropdown"> Agregar</a>
                      <ul id="BarraMenu1" class="dropdown-menu" role="menu">
                      <li class="BarraMenu"><a href="Responsable.php">Responsable</a></li>
                      <li class="BarraMenu"><a href="RegistroTipoConex.php">Tipo de Conexion</a></li>
                      <li class="BarraMenu"><a href="TipoEvento.php">Tipo de Evento</a></li>
                  </ul>
                </li>
                    <a href="NuevoUsuario.php">Crear cuenta</a>
                    <a href="Salir.php">Salir</a>
                <?php
                  }
                ?>
                <!--Inicio de session segundo usuario-->
                <?php 
                  if ($_SESSION['Nivel']==2) {
                ?>
                <li class="dropdown" style="list-style:none">
                      <a href="#" class="menubar" class="dropdown-toggle" data-toggle="dropdown"> Agregar</a>
                      <ul id="BarraMenu1" class="dropdown-menu" role="menu">
                      <li class="BarraMenu"><a href="Responsable.php">Responsable</a></li>
                  </ul>
                </li>
                    <a href="Salir.php">Salir</a>
                <?php
                  }
                ?>
                </nav>
            </div>
          </div>
        </div>
      </header>
    </div>

    <!-- Contenedor  -->
    <div class="main-wrapper">
      <section class="story-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="container">
            <div class="content">
              <h1 class="text-white text-center">Unidad Central de Atención en Informática <br> (UCAI-FACES) </h1>
              <p class="text-white text-center">Facultad de Ciencias Económicas y Sociales</p>
                <div class="text-center">
                    <img src="assets/imagenes/ULA-logo2.png" alt="">
                    <img src="assets/imagenes/logo.png" alt="">
                </div>
            </div>
          </div>
          </div>
        </div>
      </section>

    </div>

    
    <div class="main-wrapper">
      <!-- Calendario Completo -->
    <section class="featured-area">
        <div class="container">
          <h1 class="TituloCanledario"> Registro de Usuario</h1>
            <form name="FormNuevoUsuario" id="FormNuevoUsuario" method="POST" action="">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="Nombre" id="Nombre" value="<?php echo $Nombre; ?>" placeholder="Ingrese Nombre">
              </div>
              <div class="form-group">
                <label>Apellido</label>
                <input type="text" class="form-control" name="Apellido" id="Apellido" value="<?php echo $Apellido; ?>" placeholder="Ingrese Apellido">
              </div>
              <div class="form-group">
                <label>Email </label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $Email; ?>"  placeholder="Ingrese Email">
              </div>
              <div class="form-group">
                <label>password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese Password">
              </div>
              <div class="form-group">
                <label>Confirme password</label>
                <input type="password" class="form-control" name="confirm_password" id="password" placeholder="Confirme Password">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nivel Usuario</label>
                <select class="form-control" name="Nivel" id="Nivel">
                  <option value="" selected="" disabled="">Seleccione</option>
                  <option value="1">Administrador</option>
                  <option value="2">Usuario</option>
                </select>
              </div>
              <div class="text-center">
              <button type="submit" name="boton" value="Guardar" class="btn btn-success"><i class="fa fa-floppy-o text-white"></i> Guardar</button>
              <button  class="btn btn-primary" id="Buscar" ><i class="fa fa-search text-white"></i> Buscar</button>
              <button type="submit" class="btn btn-danger" value="Limpiar" name="boton"><i class="fa fa-eraser text-white"></i> Limpiar</button>
              <button type="submit" class="btn btn-danger" id="Eliminar" name="boton"><i class="fa fa-trash text-white"></i>  Eliminar</button>
              <button type="submit" class="btn btn-primary" value="Modificar" id="Modificar" name="boton"><i class="fa fa-clipboard text-white"></i> Modificar</button>
            </div>
            </form>
        </div>
      </section>
   
 <!-- Start Footer Widget Area -->
      <section class="footer-widget-area">
        <footer class="container">
            <h4 class="text-center text-white"> Copyright &copy; 2018  |  Carlos Barrios </h4>
        </footer>
      </section>
      <!-- End Footer Widget Area -->

    </div>
<form id="FormBusca" method="POST" action="" style="display: none;">
    <fieldset>
      <div class="container">
      <div class="form-group">
          <label>Buscar</label>
            <input type="text" class="form-control" name="Buscar" id="Nombre" placeholder="Buscar">
      </div>
       <button type="submit" class="btn btn-primary" id="Buscar" value="Buscar" name="boton"><i class="glyphicon glyphicon-search"></i> Buscar</button>
      </div>  
    </fieldset>
</form>

<form id="FormElimina" method="POST" action="" style="display: none;">
    <fieldset>
      <div class="container">
          <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
          <div class="form-group">
              <label>Nombre</label>
              <input type="text" class="form-control" id="Nombre" value="<?php echo $Nombre; ?>" disabled>
          </div>
          <div class="form-group">
              <label>Apellido</label>
              <input type="text" class="form-control" id="Apellido" value="<?php echo $Apellido; ?>" disabled>
          </div>
          <div class="form-group">
              <label>Email </label>
              <input type="email" class="form-control" id="email" name="vita" value="<?php echo $Email; ?>" disabled>
          </div>
       <button type="submit" class="btn btn-danger" value="Eliminar" name="boton"><i class="glyphicon glyphicon-trash"></i>  Eliminar</button>
      </div>  
    </fieldset>
</form>

<script type="text/javascript">
  $('#FormNuevoUsuario #Nivel').val("<?php echo $Nivel; ?>");

     $("#Buscar").on('click', function(){
        $("#FormBusca").css("display", "block");
              alertify.genericDialog || alertify.dialog('genericDialog',function(){
          return {
              main:function(content){
                  this.setContent(content);
              },
              setup:function(){
                  return {
                      focus:{
                          element:function(){
                              return this.elements.body.querySelector(this.get('selector'));
                          },
                          select:true
                      },
                      options:{
                          basic:true,
                          maximizable:false,
                          resizable:false,
                          padding:false
                      }
                  };
              },
              settings:{
                  selector:undefined
              }
          };
      });
      //force focusing password box
      alertify.genericDialog ($('#FormBusca')[0]).set('selector', 'input[type="text"]');
   });

      $("#Eliminar").on('click', function(){
        $("#FormElimina").css("display", "block");
              alertify.genericDialog || alertify.dialog('genericDialog',function(){
          return {
              main:function(content){
                  this.setContent(content);
              },
              setup:function(){
                  return {
                      focus:{
                          element:function(){
                              return this.elements.body.querySelector(this.get('selector'));
                          },
                          select:true
                      },
                      options:{
                          basic:true,
                          maximizable:false,
                          resizable:false,
                          padding:false
                      }
                  };
              },
              settings:{
                  selector:undefined
              }
          };
      });
      //force focusing password box
      alertify.genericDialog ($('#FormElimina')[0]).set('selector', 'input[type="text"]');
   });       

</script>
</body>
</html>