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
                $addToCart = mysqli_query($con, "INSERT INTO carrito (comic, usuario) VALUES($comicID, 1)");
                break;
        }
        
    }
    $suma = 0;
    
    $itemsInCart =  mysqli_query($con, "SELECT ca.id_carrito, c.titulo, c.precio, c.cantidad_en_almacen, c.imagen, a.nombre, g.nombre_genero, ca.usuario 
                                        FROM comics c, autor a, carrito ca, genero g, usuarios u 
                                        WHERE c.autor = a.id_autor AND ca.usuario = u.id_usuario AND ca.comic = c.id_comic AND g.id_genero=c.genero AND ca.usuario=1");
    
   
    
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
            <a class="navbar-brand" href="#">Comics eShop</a>
            
            </div>
    
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                    <form action="navbar-form navbar-right">
                        <div class="input-group form-group">
                            <input type="text" class="form-control" placeholder="Buscar">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </span>
                        </div>
                    </form>
                    </di>
                </div> 
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./catalogo.php">Catalogo</a></li>
                <li><a href="./carrito.php">Carrito</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Mi cuenta</a></li>
                    <li><a href="#">Historial de compras</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Cerrar Sesión</a></li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="cart-container">                    
                    <div class="row">
                            <div class="col-md-9">
                                <p>Carrito</p>
                            </div>
                            <div class="col-md-3">
                                <p>Precio </p>
                            </div>
                    </div>
                    <hr>
                    <?php while($row = mysqli_fetch_array($itemsInCart)) { $suma += $row['precio'] ?>
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-thumbnail cart-item-img" src="<?php echo $row['imagen']?>" alt="">
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $row['titulo'] ?></p>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                        <input type="hidden" name="method" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $row['id_carrito'] ?>">
                                        <button class="btn btn-danger">eliminar</buttton>
                                    </form>
                                </div>
                                <div class="col-md-3">
                                    <p>$<?php echo $row['precio'] ?> </p>
                                </div>
                                
                            </div>
                        </div>
                    <?php    } ?>
                   
                </div>
                
            </div>
            <div class="col-md-4">
                <form action="./checkout.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $result['id_carrito']?>">
                    <p>Total: $<?php echo $suma?></p>
                    <button>Proceder al pago</button>
                </form>
                
            
            </div>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>