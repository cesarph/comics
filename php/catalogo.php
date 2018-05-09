<?php 
    include('conexion.php');
    $genres = mysqli_query($con, "SELECT * FROM genero;");
    $authors = mysqli_query($con, "SELECT * FROM autor;");
    $editorials = mysqli_query($con, "SELECT * FROM editorial;");
    

    if (isset($_GET['genre'])) {
        $genre = strtolower($_GET['genre']);
        $comics = mysqli_query($con, "SELECT c.id_comic, c.titulo, c.precio, c.imagen, a.nombre FROM comics c, autor a, genero g WHERE c.genero = g.id_genero AND c.autor = a.id_autor AND nombre_genero='$genre'");

    } else if (isset($_GET['author'])) {
        $author = strtolower($_GET['author']);
        $comics = mysqli_query($con, "SELECT c.id_comic, c.titulo, c.precio, c.imagen, a.nombre FROM comics c, autor a WHERE c.autor = a.id_autor AND a.nombre='$author'");

    } else if (isset($_GET['editorial'])) {
        $editorial = strtolower($_GET['editorial']);
        $comics = mysqli_query($con, "SELECT c.id_comic, c.titulo, c.precio, c.imagen, a.nombre FROM comics c, autor a, editorial e WHERE c.editorial = e.id_editorial AND c.autor = a.id_autor AND nombre_editorial='$editorial'");

    } else {
        $comics = mysqli_query($con, "SELECT c.id_comic, c.titulo, c.precio, c.imagen, a.nombre FROM comics c, autor a WHERE c.autor = a.id_autor");
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
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="./catalogo.php">All</a></li>
                    <li>Generos</li>
                    <?php while($row = mysqli_fetch_array($genres)) { ?>
                        <li role="presentation"><a href="./catalogo.php?genre=<?php echo $row['nombre_genero']?>"><?php echo $row['nombre_genero']?></a></li>
                    <?php    } ?>
                    <li>Autores</li> 
                    <?php while($row = mysqli_fetch_array($authors)) { ?>
                        <li role="presentation"><a href="./catalogo.php?author=<?php echo $row['nombre']?>"><?php echo $row['nombre']?></a></li>
                    <?php    } ?>
                    <li>Editoriales</li>
                    <?php while($row = mysqli_fetch_array($editorials)) { ?>
                        <li role="presentation"><a href="./catalogo.php?editorial=<?php echo $row['nombre_editorial']?>"><?php echo $row['nombre_editorial']?></a></li>
                    <?php    } ?>
                    
                </ul>
            </div>
            <div class="col-md-9">
                <div class="comic-container row">
                    <?php while($row = mysqli_fetch_array($comics)) { ?>
                        <div class="comic col-md-4">
                            <a href="./comic.php?id=<?php echo $row['id_comic'] ?>">
                                <img class="img-thumbnail img-comic" src="<?php echo $row['imagen']?>" alt="<?php echo $row['titulo']?>">
                                <p><?php echo $row['titulo'] ?></p>
                            </a>
                            <p>de <?php echo $row['nombre']?></p>
                            <p>$<?php echo $row['precio']?></p>
                            
                            
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>