<?php
  //realizar la conexion desde otro archivo 
include 'controlador.php';
date_default_timezone_set('America/Caracas');
session_start();

 if(!isset($_SESSION["email"]) and !isset($_SESSION["Nivel"])){ //Comprobacion de inicio de session

    header('Location:login.php');
    exit; 
  }


    //Preparar la consulta
  $consulta = "SELECT * FROM tipo_conexion"; 
  //Ejecutar la consulta
  $resultado = mysql_query($consulta) or die(mysql_error());


  //recibir el boton  
  $boton=$_POST["boton"];
  
  $id_conexion=$_POST["id_conexion"];
  $conexion= $_POST['conexion'];
  

// Almacenar los datos
if($boton=="Guardar"){


  $sql = "insert into tipo_conexion (tipo) values ('$conexion')";
      
            if(mysql_query($sql)){
              
                  echo '<script>alert("Datos Guardados"); window.location="RegistroTipoConex.php"</script>';

            }else{
                  echo '<script>alert("Datos NO Guardados");</script>';
            }

}




if($boton=="Limpiar"){
echo "<script>window.location='RegistroTipoConex.php'</script>";
}

if($boton=="Buscar"){
  $sql="SELECT * FROM tipo_conexion where tipo like '$conexion%' ";
  $busqueda=mysql_query($sql);
  if( $row=mysql_fetch_array($busqueda)){

    $idConex = $row['id_conexion'];
    $tipo = $row['tipo'];

    }else{
    echo '<script>alert("Registro NO EXISTE en el Sistema");</script>';
  }
  
}

// Eliminar los datos
if($boton=="Eliminar"){

  if($id_conexion!=""){

    $sql="delete from tipo_conexion where id_conexion ='$id_conexion'";
    if (mysql_query($sql)){

        echo '<script>alert("Datos Eliminados");  window.location="RegistroTipoConex.php";</script>';
    }

  }else{

    echo '<script>alert("Para poder ELIMINAR debe realizar una busqueda");</script>';

  }
  
}

// Modificar los datos
if($boton=="Modificar"){

         $sql="update tipo_conexion set tipo ='$conexion' where id_conexion ='$id_conexion'";

            if(mysql_query($sql)){

                    echo '<script>alert("Datos Modificados");  window.location="RegistroTipoConex.php";</script>';

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
          <h1 class="TituloCanledario"> Tipo de Conexion</h1>
                  <br>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover dataTable no-footer" width="100%">
                      <thead>
                        <tr>
                          <th>idConexión</th>
                          <th>Tipo Conexión</th>
                        </tr>
                      </thead>
                      <tbody>                 
                        <?php
                        while($fila = mysql_fetch_assoc($resultado)){
                        ?>
                        <tr class="odd gradeX">
                          <td><?php echo  $fila["id_conexion"] ?></td>
                          <td><?php echo $fila["tipo"] ?></td>
                        </tr>
                        <?php
                        }
                        ?>                      
                      </tbody>
                    </table>
                    <br>
                  <form method="POST" action="" name="FormRegConex" id="FormRegConex">
                   <div class="form-group">
                    <label>Conexion</label>
                    <input type="hidden" name="id_conexion" id="id_conex" value="<?php echo  $idConex; ?>">
                    <input type="text" class="form-control" name="conexion" id="tipo" placeholder="Ingrese tipo de conexion" value="<?php echo  $tipo; ?>">
                  </div>
                  <div class="text-center">
                  <button type="submit" name="boton" value="Guardar" id="Guardar" class="btn btn-success"><i class="fa fa-floppy-o text-white"></i> Guardar</button>
                  <button type="submit" class="btn btn-danger" value="Limpiar" name="boton"><i class="fa fa-eraser text-white"></i> Limpiar</button>
                  <button type="submit" class="btn btn-primary" value="Buscar" name="boton"><i class="fa fa-search text-white"></i> Buscar</button>
                  <button type="submit" class="btn btn-danger" value="Eliminar" name="boton"><i class="fa fa-trash text-white"></i>  Eliminar</button>
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
</body>
</html>