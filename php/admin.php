<?php 
    include('conexion.php');
    $method = "";
    $comicID = "";
    $methodPOST = "";

    if (isset($_GET['method'])) {
        $method = $_GET['method'];
    }
    
    if (isset($_GET['id'])) {
        $comicID = $_GET['id'];
    }
    if (isset($_POST['id'])) {
        $comicID = $_POST['id'];
    }

    if (isset($_POST['method'])) {
        $methodPOST = $_POST['method'];
    }
    
    if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" ){
        $userID = $_SESSION['userID'];
        $user = mysqli_query($con, "SELECT u.esAdmin FROM usuarios u WHERE u.id_usuario=$userID");
        $user = mysqli_fetch_array($user);
        
        if (!$user['esAdmin']) {
            header('Location: ../index.php');
        }

    } else {
        header('Location: ../index.php');
    }
    $authors = mysqli_query($con, "SELECT nombre, id_autor FROM autor");
    $editorials = mysqli_query($con, "SELECT nombre_editorial, id_editorial FROM editorial");
    $genres = mysqli_query($con, "SELECT nombre_genero, id_genero FROM genero");

       
    switch($method) {
        case 'Eliminar':
            $user = mysqli_query($con, "DELETE FROM comics WHERE id_comic=$comicID");
            header('Location: ./catalogo.php');
            break;
        case 'Añadir':
            $result['nombre'] = '';
            $result['nombre_genero'] = '';
            $result['nombre_editorial'] = '';
            $result['titulo'] = '';
            $result['descripcion'] = '';
            $result['precio'] = '';
            $result['imagen'] = '';
            break;
        case 'Editar':
            $comics = mysqli_query($con, "SELECT c.id_comic, c.descripcion, c.titulo, c.precio, c.cantidad_en_almacen, c.imagen, a.nombre, g.nombre_genero, e.nombre_editorial FROM comics c, autor a, editorial e, genero g WHERE c.autor = a.id_autor AND e.id_editorial = c.editorial AND g.id_genero=c.genero AND c.id_comic=$comicID");
            $result = mysqli_fetch_array($comics);
            break;
    }

    switch($methodPOST) {
        case 'Añadir':
            $desc = $_POST['sinopsis'];
            $price = $_POST['price'];
            $title = $_POST['title'];
            $quantity = $_POST['quantity'];
            $image = $_POST['image'];
            $author = $_POST['author'];
            $genre = $_POST['genre'];
            $editorial = $_POST['editorial'];

            $comics = mysqli_query($con, "INSERT INTO comics (descripcion, titulo, precio, cantidad_en_almacen, imagen, autor, genero, editorial ) VALUES ('$desc', '$title', '$price', '$quantity', '$image', $author, $genre, $editorial)");
            header('Location: ./catalogo.php');
            break;
        case 'Editar':

            $desc = $_POST['sinopsis'];
            $price = $_POST['price'];
            $title = $_POST['title'];
            $quantity = $_POST['quantity'];
            $image = $_POST['image'];
            $author = $_POST['author'];
            $genre = $_POST['genre'];
            $editorial = $_POST['editorial'];

            $comics = mysqli_query($con, "UPDATE comics SET descripcion='$desc', titulo='$title', precio='$price', cantidad_en_almacen='$quantity', imagen='$image', autor=$author, genero=$genre, editorial=$editorial WHERE id_comic=$comicID");
            header('Location: ./catalogo.php');
            break;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $method ?> comic</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/inicio-registro.css">
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
                            <li><a href="./cerrar-sesion.php">Cerrar Sesión</a></li>
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
        <div class="form-container">
            <div class="register-container">
                <form class="register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="form-group">
                        <label for="title" class="control-label">Titulo:</label>
                        <input type="text" class="form-control" name="title" id="natitleme" value="<?php echo $result['titulo'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="author" class=" control-label">Author:</label>
                        <select name="author" class="form-control" id="author" value="<?php echo $result['nombre'] ?>">
                            <?php while($author = mysqli_fetch_array($authors)) { ?>
                                <option value="<?php echo $author['id_autor'] ?>" <?php if($author['nombre'] == $result['nombre'] ) echo "selected"  ?>><?php echo $author['nombre'] ?></option>
                            <?php }  ?>
                        </select>
                        <a class="" href="./new-category.php?category=autor&method=<?php echo $method ?>&id=<?php echo $comicID?>">Añadir autor</a>
                    </div>
                    <div class="form-group">
                        <label for="price" class=" control-label">Precio:</label>
                        <input type="text" class="form-control" name="price" id="price" value="<?php echo $result['precio'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="genre" class="control-label">Genero</label>
                        <select name="genre" class="form-control" id="genre" >
                            <?php while($genre = mysqli_fetch_array($genres)) { ?>
                                <option value="<?php echo $genre['id_genero'] ?>" <?php if($genre['nombre_genero'] == $result['nombre_genero'] ) echo "selected"  ?>><?php echo $genre['nombre_genero'] ?></option>
                            <?php }  ?>
                        </select>
                        <a class="" href="./new-category.php?category=genero&method=<?php echo $method ?>&id=<?php echo $comicID?>">Añadir genero</a>
                    </div>
                    <div class="form-group">
                        <label for="editorial" class="control-label">Editorial</label>
                        <select name="editorial" class="form-control" id="editorial" >
                            <?php while($editorial = mysqli_fetch_array($editorials)) { ?>
                                <option value="<?php echo $editorial['id_editorial'] ?>" <?php if($editorial['nombre_editorial'] == $result['nombre_editorial'] ) echo "selected"  ?>><?php echo $editorial['nombre_editorial'] ?></option>
                            <?php }  ?>
                        </select>
                        <a class="" href="./new-category.php?category=editorial&method=<?php echo $method ?>&id=<?php echo $comicID ?>">Añadir editorial</a>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label">Cantidad en Almacen:</label>
                        <input type="number" min="0" class="form-control" name="quantity" id="quantity" value="<?php echo $result['cantidad_en_almacen']  ?>">
                    </div>
                    <div class="form-group">
                        <label for="imagen" class="control-label">Imagen:</label>
                        <input type="text" class="form-control" name="image" id="imagen" value="<?php echo $result['imagen'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="sinopsis" class="control-label">Sinopsis:</label>
                        <textarea  rows="5" class="form-control" name="sinopsis"><?php echo $result['descripcion'] ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" name="method" value="<?php echo $method ?>">
                        <input type="hidden" name="id" value="<?php echo $comicID ?>">
                        <button type="submit" class="btn btn-primary ">Enviar</button>  
                    </div>
                </form>
            </div>
            
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>