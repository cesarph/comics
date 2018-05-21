<?php 
    include('conexion.php');

    if(isset($_POST['method'])) {
        switch ($_POST['method']) {
            case 'delete':
                $itemID = $_POST['id'];
                $deleteFromCart = mysqli_query($con, "DELETE FROM carrito where id_carrito=$itemID");
                break;
            case 'update':
                $comicID = $_POST['id'];
                $quantity = $_POST['quantity'];
                $userID = $_SESSION['userID'];
                $addToCart = mysqli_query($con, "INSERT INTO carrito (comic, usuario, cantidad) VALUES($comicID, $userID, $quantity)");
                break;
            case 'updateQuantity':
                $cartID = $_POST['id'];
                $quantity = $_POST['quantity'];
                $userID = $_SESSION['userID'];
                $updateQuantity = mysqli_query($con, "UPDATE carrito SET cantidad=$quantity WHERE id_carrito=$cartID");
        }
        
    }
    $suma = 0;
    if(isset($_SESSION['userID']) && $_SESSION['userID'] != "" ){
        $userID = $_SESSION['userID'];
        $user = mysqli_query($con, "SELECT u.esAdmin FROM usuarios u WHERE u.id_usuario=$userID");
        $user = mysqli_fetch_array($user);

        $itemsInCart =  mysqli_query($con, "SELECT ca.id_carrito, ca.cantidad, c.titulo, c.precio, c.cantidad_en_almacen, c.imagen, a.nombre, g.nombre_genero, ca.usuario 
                                        FROM comics c, autor a, carrito ca, genero g, usuarios u 
                                        WHERE c.autor = a.id_autor AND ca.usuario = u.id_usuario AND ca.comic = c.id_comic AND g.id_genero=c.genero AND ca.usuario=$userID");
    
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
                            <div class="col-xs-9">
                                <strong>Carrito</strong>
                            </div>
                            <div class="col-xs-3">
                                <strong>Precio </strong>
                            </div>
                    </div>
                    <hr>
                    <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" && mysqli_num_rows($itemsInCart) ) { 
                        while($row = mysqli_fetch_array($itemsInCart)) { $suma += $row['cantidad']*$row['precio'] ?>
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-sm-3 visible-sm visible-md visible-lg">
                                        <img class="img-thumbnail img-responsive cart-item-img" src="<?php echo $row['imagen']?>" alt="">
                                    </div>
                                    <div class="col-sm-6 col-xs-9">
                                        <p><?php echo $row['titulo'] ?></p>
                                        
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                            Cantidad: <select name="quantity" id="quantity">
                                                <?php for($i = 1; $i <= $row['cantidad_en_almacen']; $i++) { ?>
                                                    <option value="<?php echo $i ?>" <?php if ($row['cantidad'] == $i) echo "selected"?>><?php echo $i ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="method" value="updateQuantity">
                                            <input type="hidden" name="id" value="<?php echo $row['id_carrito'] ?>">
                                            <button class="btn btn-sm btn-primary">Cambiar</buttton>
                                        </form>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                            <input type="hidden" name="method" value="delete">
                                            <input type="hidden" name="id" value="<?php echo $row['id_carrito'] ?>">
                                            <button class="btn btn-sm btn-danger">Eliminar</buttton>
                                        </form>
                                        
                                    </div>
                                    <div class="col-sm-3 col-xs-3">
                                        <p>$<?php echo $row['precio'] ?> </p>
                                    </div>
                                    
                                </div>
                            </div>
                    <?php    } 
                         } else if (isset($_SESSION['userID']) && $_SESSION['userID'] != "") { ?>
                            <p>Tu carrito está vacio</p>
                    <?php } else { ?>
                            <p>Tiene que tener cuenta para poder usar esta función</p>
                    <?php } ?>
                </div>
                
            </div>
            
            <div class="col-md-4">
                <div class="checkout-form">
                    <form action="./checkout.php" method="POST">
                        <p><strong>Total:</strong> $<?php echo $suma?></p>
                        <input type="hidden" name="id" value="<?php echo $_SESSION['userID']?>">
                        <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" ) { ?>
                            <button class="btn btn-success" <?php if(!mysqli_num_rows($itemsInCart)) echo "disabled"?>>Proceder al pago</button>
                        <?php } else { ?>
                            <button class="btn btn-success" disabled>Proceder al pago</button>
                            <p class="not-available">Para usar esta función debe tener una cuenta</p>
                        <?php } ?>
                    </form>
                </div>
                
            </div>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>