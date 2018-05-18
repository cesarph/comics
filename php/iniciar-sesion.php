<?php 
    include('conexion.php');
    
    $error = "";
    if (isset($_POST['user']) && isset($_POST['password'])) {
        $email = $_POST['user'];

        $passwordQuery = mysqli_query($con, "SELECT id_usuario, contra FROM usuarios WHERE correo='$email'");
        $password = mysqli_fetch_array($passwordQuery);

        if (!mysqli_num_rows($passwordQuery)) {
            $error = "El correo o la contraseña está incorrecto!";
           
        } else {
            if ($_POST['password'] == $password['contra']) {
                $_SESSION['userID'] = $password['id_usuario'];
                header('Location: ./catalogo.php');
                
            } else {
                $error = "El correo o la contraseña está incorrecto!";
            }
        }
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
                    <form class="navbar-form navbar-right" action="./catalogo.php" method="GET">
                        
                        <div class="input-group">
                            <input type="text" class="form-control" name="titulo" placeholder="Buscar">
                            <span class="input-group-btn">
                                <button class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </span>
                        </div>
                    </form>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    
                    <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] != "") { ?>
                        <li><a href="./carrito.php">Carrito</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="./cuenta.php">Mi cuenta</a></li>
                                <li><a href="./historial.php">Historial de compras</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="./cerrar-sesion.php">Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    <?php }  else { ?>
                        <li><a href="./iniciar-sesion.php">Iniciar Sesión</a></li>
                        <li><a href="./registro.php">Registrarse</a></li>
                    <?php }?>
                    
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class=form-container>
            <?php if ($error != "") { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $error ?>
                </div>
            <?php } ?>
            <div class="login-container">
                <form class="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="form-group">
                        <label for="user" class="control-label">Correo</label>
                        <input type="text" class="form-control" name="user" id="user">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        <div class="change">
                            <strong>No tienes cuenta?</strong><a href="./registro.php"> Registrate!</a>
                        </div>             
                    </div>
                </form>
            </div>
           
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>