<?php include('./php/conexion.php');

  if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" ){
    $userID = $_SESSION['userID'];
    $user = mysqli_query($con, "SELECT u.esAdmin FROM usuarios u WHERE u.id_usuario=$userID");
    $user = mysqli_fetch_array($user);
  } else {
    $user['esAdmin'] = 0;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.css">
  </head>
  <body>
      <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./index.php">Comics</a>
            
            </div>
    
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="./php/catalogo.php">Catalogo</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    
                    <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] != "") { ?>
                        <?php if ($user['esAdmin']) { ?>
                            <li><a href="./php/admin.php?method=Añadir">Añadir comic</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="./php/historial.php">Historial de compras</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="./php/cerrar-sesion.php">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        <?php } else {?>
                            <li><a href="./php/carrito.php">Carrito</a></>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="./php/cuenta.php">Mi cuenta</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="./php/cerrar-sesion.php">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        <?php }
                        }  else { ?>
                        <li><a href="./php/iniciar-sesion.php">Iniciar Sesión</a></li>
                        <li><a href="./php/registro.php">Registrarse</a></li>
                    <?php }?>
                    
                </ul>
            </div>
        </div>
    </nav>
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <a href="./php/comic.php?id=7">
              <img src="https://www.dccomics.com/sites/default/files/DoomsdayClock_Hub_Marquee_alt_59e142e49a5cd5.83051384.jpg" alt="...">
              <div class="carousel-caption">
                ¡Doomsday Clock esta aquí!
              </div>
            </a>
          </div>
          <div class="item">
            <a href="./php/comic.php?id=6">
              <img src="https://i.ytimg.com/vi/IraG0OVeJWU/maxresdefault.jpg" alt="...">
              <div class="carousel-caption">
                Comienza Civil War II
              </div>
            </a>
          </div>
          <div class="item">
            <a href="./php/comic.php?id=5">
              <img src="http://s3-us-west-1.amazonaws.com/dkn-wp/wp-content/uploads/2015/07/02054637/fables-banner.jpg" alt="...">
              <div class="carousel-caption">
                ¡Sale Fables #4!
              </div>
            </a>
          </div>
          
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div class="container">
        <h2 class="title">Destacado</h2>
        <div class="featured">
          <div class="row">
            <div class="col-md-6 col-xs-10">
              <a href="./php/comic.php?id=1">
                <img src="http://cdn.collider.com/wp-content/uploads/james_jean_fables_cover_01.jpg" alt="">
              </a>
            </div>
            <div class="col-md-4 col-xs-10 second-img">
              <a href="./php/comic.php?id=8">
                <img src="https://static.vix.com/es/sites/default/files/styles/large/public/d/dk-metal.jpg?itok=fJcgay_r" alt="">
              </a>
            </div>
            <div class="col-md-4 col-xs-10">
              <a href="./php/comic.php?id=9">
                <img src="https://omegaunderground.com/wp-content/uploads/2016/05/Thor-Planet-Hulk-Banner.jpg" alt="">
              </a>
            </div>
          </div>
        </div>
        
      </div>

            
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>