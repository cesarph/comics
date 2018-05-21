<?php 
    include('conexion.php');

    $suma = 0;
    if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" ){
        $userID = $_SESSION['userID'];
        $user = mysqli_query($con, "SELECT u.esAdmin FROM usuarios u WHERE u.id_usuario=$userID");
        $user = mysqli_fetch_array($user);

        if ($user['esAdmin']) {
            $selectUserHistory = mysqli_query($con, "SELECT h.id_historial_compras, h.cantidad, c.id_comic, c.imagen, c.titulo, c.precio, u.nombre_usuario FROM comics c,usuarios u, historial_compras h WHERE h.id_comic=c.id_comic and u.id_usuario=h.id_usuario ORDER BY id_historial_compras");
        } else {
            header('Location: ../index.php');
        }

        
    
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
    <title>Carrito</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/carrito.css">
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
    <div class="container">
        <div class="row"> 
            <div class="col-md-8">
                <div class="cart-container">                    
                    <div class="row">
                        <div class="col-md-5">
                            <strong>Historial de compras</strong>
                        </div>
                        <div class="col-md-2">
                            <strong>Cantidad</strong>
                        </div>
                        <div class="col-md-2">
                            <strong>Total</strong>
                        </div>
                        <div class="col-md-3">
                            <strong>Usuario</strong> 
                        </div>
                     </div>
                    <hr>
                    <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" && mysqli_num_rows($selectUserHistory) ) { 
                        while($row = mysqli_fetch_array($selectUserHistory)) { 
                         if ($user['esAdmin']) { ?>
                            <div class="cart-item">
                                <div class="row">
                                     
                                    <div class="col-md-5">
                                        <a href="./comic.php?id=<?php echo $row['id_comic'] ?>">
                                            <p><?php echo $row['titulo'] ?></p>
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <p><?php echo $row['cantidad'] ?></p>
                                    </div>
                                    <div class="col-md-2">
                                        <p>$<?php echo $row['precio']*$row['cantidad'] ?> </p>
                                    </div>
                                   
                                        
                                   
                                    <div class="col-md-3">
                                    <p><?php echo $row['nombre_usuario'] ?> </p>
                                    </div>
                                    
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="cart-item">
                            <div class="row">
                                 
                                <div class="col-md-3">
                                    <a href="./comic.php?id=<?php echo $row['id_comic'] ?>">
                                        <img class="img-responsive" src="<?php echo $row['imagen'] ?>" alt="">
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="./comic.php?id=<?php echo $row['id_comic'] ?>">
                                        <p><?php echo $row['titulo'] ?></p>
                                    </a>
                                </div>
                               
                                <div class="col-md-3">
                                    <p>$<?php echo $row['precio'] ?> </p>
                                </div>
                                
                            </div>
                        </div>
                        <?php }  } 
                         } else { ?>
                            <p>No se ha comprado ningún producto</p>
                    <?php } ?>
                    
            </div>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>