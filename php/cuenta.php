<?php 
    include('conexion.php');

    
    if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" ){
        $userID = $_SESSION['userID'];

        $user = mysqli_query($con, "SELECT u.id_usuario, u.nombre_usuario, u.tarjeta, u.direccion_postal, u.fecha_de_nacimiento, u.correo, u.esAdmin  FROM usuarios u WHERE u.id_usuario=$userID");
        $user = mysqli_fetch_array($user);

    } else {
        header('Location: ../index.php');
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catalogo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/catalogo.css">
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
            <a class="navbar-brand" href="../index.php">Comics</a>
            
            </div>
    
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="./catalogo.php">Catalogo</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    
                    <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] != "") { ?>
                        <?php if ($user['esAdmin']) { ?>
                            <li><a href="./admin.php?method=Añadir">Añadir comic</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="./historial.php">Historial de compras</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="./cerrar-sesion.php">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        <?php } else {?>
                            <li><a href="./carrito.php">Carrito</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="./cuenta.php">Mi cuenta</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="./cerrar-sesion.php">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        <?php }
                        }  else { ?>
                        <li><a href="./iniciar-sesion.php">Iniciar Sesión</a></li>
                        <li><a href="./registro.php">Registrarse</a></li>
                    <?php }?>
                    
                </ul>
            </div>
        </div>
    </nav>
    <div class="container container-catalog">
        <div class="row">
            <div class="col-md-6">
              <p><?php echo $user['nombre_usuario'] ?></p>
              <hr>
              <p><strong>Fecha de Nacimiento: </strong> <?php echo date("j M Y",strtotime($user['fecha_de_nacimiento'])) ?></p>
              <p><strong>Dirección Postal:</strong> <?php echo $user['direccion_postal'] ?></p>
              <p><strong>Tarjeta:</strong> <?php echo $user['tarjeta'] ?></p>
              <p><strong>Correo:</strong> <?php echo $user['correo'] ?></p>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>