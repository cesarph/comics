<?php 
    include('conexion.php');

    $suma = 0;
    if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" ){
        $userID = $_SESSION['userID'];

        $user = mysqli_query($con, "SELECT u.id_usuario, u.nombre_usuario, u.tarjeta, u.direccion_postal, u.esAdmin FROM usuarios u WHERE u.id_usuario=$userID");
        $user = mysqli_fetch_array($user);

        $itemsInCart =  mysqli_query($con, "SELECT ca.id_carrito, ca.cantidad, ca.comic, c.titulo, c.precio, c.cantidad_en_almacen, a.nombre, g.nombre_genero, ca.usuario 
                                        FROM comics c, autor a, carrito ca, genero g, usuarios u 
                                        WHERE c.autor = a.id_autor AND ca.usuario = u.id_usuario AND ca.comic = c.id_comic AND g.id_genero=c.genero AND ca.usuario=$userID");

        if(isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'proceed':
                    
                    while($row = mysqli_fetch_array($itemsInCart)) {
                        $comicID = $row['comic'];
                        $quantityUser = $row['cantidad'];
                        $insertToHistory = mysqli_query($con, "INSERT INTO historial_compras (id_comic, id_usuario, cantidad) VALUES($comicID, $userID, $quantityUser)");

                        $selectComic = mysqli_query($con, "SELECT cantidad_en_almacen FROM comics WHERE id_comic=$comicID");
                        $quantity = mysqli_fetch_array($selectComic)['cantidad_en_almacen'];
                        $newQuantity = $quantity - $quantityUser;
                        $updateComic = mysqli_query($con, "UPDATE comics SET cantidad_en_almacen=$newQuantity WHERE id_comic=$comicID"); 
                    }
                    
                    $deleteCart = mysqli_query($con, "DELETE FROM carrito WHERE usuario=$userID");
                    header('Location: ./compra-exitosa.php');
                    break;
            }
            
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
                        <div class="col-md-12 checkout-title">
                            <strong>Resumen de compra</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <strong>Nombre:</strong> <?php echo $user['nombre_usuario'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Tarjeta:</strong> <?php echo $user['tarjeta'] ?>
                        </div>
                        <div class="col-md-6">
                            <strong>Dirección:</strong> <?php echo $user['direccion_postal'] ?>
                        </div>
                    </div>
                    <hr>
                    <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" && mysqli_num_rows($itemsInCart) ) { 
                        while($row = mysqli_fetch_array($itemsInCart)) { $suma += $row['precio']*$row['cantidad'] ?>
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <p><?php echo $row['titulo'] ?> x<?php echo $row['cantidad'] ?></p>
                                        
                                    </div>
                                    <div class="col-xs-4">
                                        <p>$<?php echo $row['precio']*$row['cantidad'] ?> </p>
                                    </div>
                                    
                                </div>
                            </div>
                    <?php    } 
                         } else { ?>
                            <p>No tiene nada que comprar</p>
                    <?php } ?>
                    <hr>    
                    <div class="row">
                        <div class="col-xs-8">
                            <strong>Total</strong>
                        </div>
                        <div class="col-xs-4">
                            <p>$<?php echo $suma?></p>
                        </div>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <input type="hidden" name="action" value="proceed">
                        <button class="btn btn-success checkout-btn">Confirmar compra</button>
                    </form>
            </div>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>