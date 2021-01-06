<?php
session_start();
include('newHeader.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dicas de Emergência</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">    </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body>

  <div class="container" style="max-height:400px;">
    <div id="magicCarousel" class="carousel slide my-5" data-ride="carousel">

      <!--    Carousel Indicators    -->
      <ol class="carousel-indicators">
        <li data-target="#magicCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#magicCarousel" data-slide-to="1"></li>
        <li data-target="#magicCarousel" data-slide-to="2"></li>
        <li data-target="#magicCarousel" data-slide-to="3"></li>
      </ol>

      <!--    Carousel Slider    -->
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img src="Imagens/daisies.jpg" class="d-block w-100">
          <div class="carousel-caption">
            <h3>Dica #1</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ullamcorper fringilla porta. Curabitur pharetra orci porttitor, dapibus quam in, vulputate felis. Vivamus ac fermentum dui, vel fermentum ipsum. Vivamus molestie sapien quis accumsan mollis. Vestibulum ultrices augue eget dui lobortis blandit ut nec nisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum lobortis eros eu erat egestas, vel placerat purus posuere.</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="Imagens/daisies.jpg" class="d-block w-100">
          <div class="carousel-caption">
            <h3>Dica #2</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ullamcorper fringilla porta. Curabitur pharetra orci porttitor, dapibus quam in, vulputate felis. Vivamus ac fermentum dui, vel fermentum ipsum. Vivamus molestie sapien quis accumsan mollis. Vestibulum ultrices augue eget dui lobortis blandit ut nec nisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum lobortis eros eu erat egestas, vel placerat purus posuere.</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="Imagens/daisies.jpg" class="d-block w-100">
          <div class="carousel-caption">
            <h3>Dica #3</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ullamcorper fringilla porta. Curabitur pharetra orci porttitor, dapibus quam in, vulputate felis. Vivamus ac fermentum dui, vel fermentum ipsum. Vivamus molestie sapien quis accumsan mollis. Vestibulum ultrices augue eget dui lobortis blandit ut nec nisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum lobortis eros eu erat egestas, vel placerat purus posuere.</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="Imagens/daisies.jpg" class="d-block w-100">
          <div class="carousel-caption">
            <h3>Dica #4</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ullamcorper fringilla porta. Curabitur pharetra orci porttitor, dapibus quam in, vulputate felis. Vivamus ac fermentum dui, vel fermentum ipsum. Vivamus molestie sapien quis accumsan mollis. Vestibulum ultrices augue eget dui lobortis blandit ut nec nisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum lobortis eros eu erat egestas, vel placerat purus posuere.</p>
          </div>
        </div>

        <!--     Carousel Controls     -->
        <a href="#magicCarousel" class="carousel-control-prev" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a href="#magicCarousel" class="carousel-control-next" role="button" data-slide="next">
          <span class="carousel-control-next-icon"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </div>

  <style>
    .carousel {
      position: relative;
    }

    .carousel-caption {
      position: absolute;
      background: rgba(0, 0, 0, 0.4);
      padding: 15px 10px;
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 5%;
    }
  </style>

</body>

</html>