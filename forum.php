<?php

session_start();
include('newHeader.php');
include "config.php";

// FÓRUM DE PUBLICAÇÕES

$posts = [];

//buscar à bd os posts todos que existem, ordenados do mais recente para o mais antigo
$post_query = "SELECT u.user_id, u.nome, p.POST_ID, p.title, DATE(p.data) as data, p.imagem, p.text
              FROM posts as p, utilizadores as u
              WHERE p.id_user = u.user_id
              ORDER BY DATE(p.data) DESC;";

$result = mysqli_query($mysqli, $post_query);

$resultCheck = mysqli_num_rows($result);

//se houver 1 ou mais posts na BD, são guardados no array $posts
if ($resultCheck > 0) {
  while ($found = mysqli_fetch_assoc($result)) {
    $posts[] = $found;
  }
  //se não houver posts ainda, guarda esta mensagem numa variável
} else {
  $noresults = "No results were found :(";
}

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fórum</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <!-- JQuery, Moment, Bootstrap & JQuery UI Javascript files -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <!-- Custom Amik@ CSS -->
  <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
  <link rel="stylesheet" type="text/css" href="CSS/forum.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

  <!-- Date Picker JS, CSS e ficheiro de idioma PT -->
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/messages/messages.pt-br.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

  <script>
    /* faz o datepicker aparecer quando o campo da data é clicado*/
    $(document).ready(function() {
      $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        locale: 'pt-br',
        format: 'dd-mm-yyyy'

      });
    });
  </script>

</head>

<style>
  body {
    padding-top: 95px;
  }
</style>

<body>

  <br>
  <?php
  // IMPRIME MENSAGENS DE ERRO
  if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
  ?>

  <!-- TÍTULO -->
  <div align="center" style="margin-top:50px;">
    <div class="title-back">
      <h1 class="title ">
        Fórum
      </h1>
    </div>
  </div>
  </div>

  <br>
  <br>
  <br>
  <div class="container">
    <!-- BOTÃO DE ADICIONAR PUBLICAÇÃO AO FÓRUM -->
    <?php if (isset($_SESSION['loggedin'])) { ?> <button id="addpost" class="btn-grad" style="margin:auto;">+</button> <?php } ?>
  </div>

  <!-- IMPRIME MENSAGEM QUANDO NÃO HÁ NENHUM POST NA BD -->
  <p style="text-align:center;"><?php if (isset($noresults)) echo $noresults; ?></p>

  <div class="blog-feed">
    <!-- para cada publicação, imprime informações e outros botões -->
    <?php foreach ($posts as $post) : ?>
      <div class="blog-post-comment">

        <div class="blog-post">
          <div class="blog-post__img">
            <!-- Imagem com base64 encoding -->
            <img class="post-img" <?php echo 'src="data:image/jpeg;base64,' . base64_encode($post['imagem']) . '"' ?>>
          </div>
          <div class="blog-post__info">
            <div class="blog-post__date">
              <!-- Data por extenso em português -->
              <span><?php
                    setlocale(LC_TIME, 'pt', 'pt.utf-8', 'pt.utf-8', 'portuguese');
                    date_default_timezone_set('Europe/Lisbon');
                    $date_string = utf8_encode(strftime('%A, %d de %B de %Y', strtotime($post['data'])));
                    echo $date_string;

                    ?></span>
            </div>


            <h1 class="blog-post__title"><?php echo $post['title']; ?></h1>

            <p class="blog-post__text">
              <?php echo $post['text']; ?>
              <br><br>
              <b style="font-size:15px;">Publicado por:</b>
              <?php echo $post['nome']; ?>
            </p>

            <div>
              <div style="float:left;margin-right:12px;">
                <!-- Botão de comentar, que aciona classe "comentar" no javascript, para o user introduzir o comentário -->
                <?php if (isset($_SESSION['loggedin'])) { ?><a href="javascript:;" class="comentar blog-post__cta">Comentar</a> <?php } ?>
              </div>
              <div style="float:right;">
                <form id="apagarPost" method="POST" action="deletePost.php?postId=<?php echo $post['POST_ID'] ?>">
                  <?php if (isset($_SESSION['loggedin']) && $post['user_id'] == $_SESSION['user_id']) { ?>
                    <!-- Botão de apagar o post (para o utilizador que o publicou) -->
                    <button class="blog-post__remove" type="submit" name="submit">Remover post</button>
                  <?php } ?>
                </form>
              </div>
            </div>

            <!-- Quando um utilizador clica em comentar, aparece um campo para o comentário e toda a info incluindo data e id do post é enviada para a pag comentario.php -->
            <form action="comentario.php?postId=<?php echo $post['POST_ID'] ?>" method="post" autocomplete="off">
              <div class="comment_form_wrapper" style="display: none;"><br>
                <input type="text" name="comentario" class="form-control rounded-corner" style="font-size:17px;" placeholder="Escreve um comentário..."><br>
                <input type="hidden" name="data_com" value="<?php echo date("Y-m-d H:i:s"); ?>">
                <span class="input-group-btn p-l-10">
                  <input class="btn btn-primary" style="font-size:15px;" value="Submeter" id="submit" type="submit" onclick="javascript:window.location.reload(true)">
                </span>
              </div>
            </form>

          </div>

        </div>

        <div class="blog-post__comment">

          <?php

          $postid = $post['POST_ID'];

          //vai buscar todos os comentários do post que está a ser imprimido
          $com_query = "SELECT * FROM comentarios WHERE POST_ID='$postid'";
          $com_result = mysqli_query($mysqli, $com_query) or die(mysqli_error($mysqli));
          $resultCheck = mysqli_num_rows($com_result);

          if ($resultCheck > 0) {

            $comentarios = [];
            while ($com = mysqli_fetch_assoc($com_result)) {
              $comentarios[] = $com;
              $nocomments = 0;
            }
          } else {
            //flag para saber se há ou não comentários
            $nocomments = 1;
          }

          ?>

          <h1 class="blog-post__title">Comentários:</h1>
          <hr>

          <p class="blog-post__text">

            <!-- Se houver comentários... -->
            <?php if ($nocomments == 0) foreach ($comentarios as $comentario) :
              $user_com = $comentario['ID_USER'];

              //vai buscar o nome do utilizador que comentou, a partir do id
              $user_query = "SELECT nome FROM utilizadores WHERE user_id='$user_com'";

              $user_result = mysqli_query($mysqli, $user_query) or die(mysqli_error($mysqli));

              while ($un = mysqli_fetch_assoc($user_result)) {
                $username_com = $un;
              } ?>


              <!-- Imprime comentário -->
          <p> <?php echo $comentario['COMENTARIO']; ?> </p>

          <div style="float:right;">
            <form id="apagarComentario" method="POST" action="deleteComment.php?commentId=<?php echo $comentario['ID_COMENTARIO'] ?>">
              <!-- Botão para apagar o comentário (só para quem o criou) -->
              <?php if (isset($_SESSION['loggedin']) && $user_com == $_SESSION['user_id']) { ?>
                <button type="submit" name="submit" style="margin-left:5px; padding:12px;" class=" blog-post__remove">
                  <i class="fas fa-trash"></i>
                </button>
              <?php } ?>
            </form>
          </div>
          <div style="font-size:13px;">
            <b>Publicado por:</b>
            <?php echo $username_com['nome']; ?>
          </div>
          <?php echo $comentario['DATA']; ?>
          <hr>

        <?php endforeach; ?>

        <!-- Mensagem para quando ninguém comentou a publicação ainda -->
        <?php if ($nocomments == 1) : ?>
          Ainda ninguém comentou esta publicação :(
        <?php endif; ?>

        </p>
        </div>
      </div>
    <?php endforeach; ?>

  </div>


  <!-- POPUP ADICIONAR POST -->
  <div class="modal fade" id="adicionarPost" tabindex="-1" role="dialog" style="font-size:17px;" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="font-size:17px;">
        <div class="modal-header">
          <h5 class="modal-title" style="font-size:27px; font-family: 'Chewy'; color: #03036B;">Adiciona uma publicação!</h5>
          <button type="button" class="close" data-dismiss="modal" style="font-size:22px;" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="novaPublicacao" method="POST" action="new_post.php" enctype="multipart/form-data" autocomplete="off">

            <div class="form-group col-sm-10">
              <label><b>Título:</b></label>
              <input type="text" class="form-control" name="titulo" id="titulo" style="font-size:17px;">
            </div>

            <div class="form-group col-sm-10">
              <label><b>Data:</b></label>
              <input id="datepicker" name="date" class="form-control" type="text" style="font-size:17px;"></input>
            </div>


            <div class="form-group col-sm-10">
              <label><b>Descrição:</b></label>
              <textarea class="form-control" type="text" rows="6" placeholder="Escreve qualquer coisa sobre este dia..." name="texto" style="font-size:17px;"></textarea>
            </div>

            <div class="form-group col-sm-10">
              <label><b>Foto:</b></label>
              <input type="file" name="foto">
            </div>

            <div class="modal-footer">
              <button type="submit" id="submit" name="submit" form="novaPublicacao" class="btn-grad" style="font-size:15px;">Publicar</button>
              <button type="button" class="btn btn-danger" style="font-size:15px; border-radius: 50px; text-transform:uppercase;" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>





  <script>
    // mostra o popup de adicionar publicação quando o botão "+" é clicado
    $('#addpost').on('click', function() {
      $('#adicionarPost').modal('show');
    });

    // mostra o campo de escrever comentário, quando o botão "comentar" é clicado
    $(document).ready(function() {
      $('.comentar').click(function() {
        $('.comment_form_wrapper').toggle();
      });
    });
  </script>

</body>


</html>