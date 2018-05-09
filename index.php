<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comics eShop</title>
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
                  <li><a href="./php/catalogo.php">Catalogo</a></li>
                  <li><a href="./php/carrito.php">Carrito</a></li>
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
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
          <div class="carrousel">
              <div class="mySlides fade">
                <img src="http://i.imgur.com/wwxiFqF.jpg">
                <div class="text">It's not about what you see, but about what sees you!</div>
              </div>
              <div class="mySlides fade">
                <img src="http://i.imgur.com/AsnCmBd.jpg">
                <div class="text">Caption Two</div>
              </div>
          
              <div class="mySlides fade">
                <img src="http://i.imgur.com/VGmpnRR.jpg">
                <div class="text">Caption Three</div>
              </div>
              
              <a class="prev" onclick="plusSlides(-1)">❮</a>
              <a class="next" onclick="plusSlides(1)">❯</a>
              
            </div>
            <div class="hightlight">
              destacado
            </div>

          
            

            <script>
                var slideIndex = 0, t;
                var slides = document.querySelectorAll(".mySlides");
                showSlides();
                
            
                function showSlides() {
                  checkLimits();
                  cleanSlides();

                  slides[slideIndex++].style.display = "block";
    
                  t = setTimeout(showSlides, 5000);
                }
                
                function plusSlides(num) {
                  clearTimeout(t)
                  slideIndex += num;
                  
                  showSlides();
                }
                
                function checkLimits(){
                  if (slideIndex > slides.length - 1) {
                    slideIndex = 0;
                  }
                  if (slideIndex < 0) {
                    slideIndex = 2;
                  }
                }

                function cleanSlides() {
                  for (var i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                  }
                }
            </script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>