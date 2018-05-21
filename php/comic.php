<?php 
    include('conexion.php');
    $comicID = $_GET['id'];
    $onStock = true;
    $comics = mysqli_query($con, "SELECT c.id_comic, c.descripcion, c.titulo, c.precio, c.cantidad_en_almacen, c.imagen, a.nombre, g.nombre_genero, e.nombre_editorial FROM comics c, autor a, editorial e, genero g WHERE c.autor = a.id_autor AND e.id_editorial = c.editorial AND g.id_genero=c.genero AND c.id_comic=$comicID");
    $result = mysqli_fetch_array($comics);

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $result['titulo']?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/comic.css">
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
    <div class="container-comic">
        <div class="row"> 
            <div class="col-sm-1 visible-sm visible-md">
                
            </div>
            <div class="col-xs-11 col-sm-5 col-lg-3 col-md-3">
                <img class="img-thumbnail comic-info-img" src="<?php echo $result['imagen']?>" alt="">
            </div>
            <div class="col-xs-11 col-sm-4 col-lg-6 col-md-5 comic-info" >
                <div class="title">
                    <p class="comic-title"><?php echo $result['titulo']?></p>
                    <p class="comic-author">de <?php echo $result['nombre']?></p>
                </div>
                <div class="price">
                 <p><strong>Precio:</strong> $<?php echo $result['precio']?></p>
                </div>
                <div class="description">
                    <p><strong>Sinopsis</strong></p>
                    <p><?php echo $result['descripcion']?></p>
                </div>
                <div class="publisher">
                    <p class="genre"><strong>Género:</strong> <?php echo $result['nombre_genero']?></p>
                    <p class="editorial"><strong>Editorial:</strong> <?php echo $result['nombre_editorial']?></p>
                    <?php if ($user['esAdmin']) { ?>
                        <p><strong>Cantidad en almacen:</strong> <?php echo $result['cantidad_en_almacen']?></p>
                    <form action="./admin.php" >
                        <input type="hidden" name="id" value="<?php echo $comicID ?>">
                        <input class="btn btn-sm btn-primary" name="method" type="submit" value="Editar">
                        <input class="btn btn-sm btn-danger" name="method" type="submit" value="Eliminar">
                    </form>
                    <?php } ?>
                </div>
            </div>
            <?php if (!$user['esAdmin']) { ?>
                <div class="col-xs-12 col-sm-3 col-lg-3 col-md-2 cart-button">
                    <?php if ($result['cantidad_en_almacen'] == 0) { $onStock=false?>
                        <p>Estado: <span class="not-available">No Disponible</span></p>  
                    <?php } else if ($result['cantidad_en_almacen'] < 6) {?>
                        <p>Estado: <span class="warning">¡Solo quedan <?php echo $result['cantidad_en_almacen']?> copias en existencia!</span></p>
                    <?php } else { ?>
                        <p>Estado: <span class="available">Disponible!</span></p>
                    <?php } ?>
                    <form action="./carrito.php" method="POST">
                        <?php if ($result['cantidad_en_almacen']) {?>
                            <select name="quantity" id="quantity">
                                <?php for($i = 1; $i <= $result['cantidad_en_almacen']; $i++) { ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                        <input type="hidden" name="method" value="update">
                        <input type="hidden" name="id" value="<?php echo $result['id_comic']?>">
                        <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" ) { ?>
                            <button class="btn btn-success" <?php if (!$onStock) echo "disabled"?>>Añadir al carrito</button>
                        <?php } else { ?>
                            <button class="btn btn-success" disabled>Añadir al carrito</button>
                            <p class="not-available">Para usar esta función debe tener una cuenta</p>
                        <?php } ?>
                    </form>
                    
                </div>
            <?php } ?>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>