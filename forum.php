<?php

session_start();
include('header.php');
include "config.php";

$posts = [];

$post_query = "SELECT u.user_id, u.nome, p.POST_ID, p.title, DATE(p.data) as data, p.imagem, p.text
              FROM posts as p, utilizadores as u
              WHERE p.id_user = u.user_id
              ORDER BY DATE(p.data) DESC;";

$result = mysqli_query($mysqli, $post_query);

$resultCheck = mysqli_num_rows($result);

//if there is 1 or more results, save them in $posts
if ($resultCheck > 0) {
  while ($found = mysqli_fetch_assoc($result)) {
    $posts[] = $found;
  }
  //if not, show a message saying that no results were found
} else {
  echo "No results were found :(";
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
  <link rel="stylesheet" type="text/css" href="CSS/forum.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>

<body>

  <div align ="center" style="margin-top:50px;">
        <div class="title-back" >
            <h1 class = "title ">
                Fórum
            </h1>
        </div>
    </div>


  <div class="blog-feed">
    <?php foreach ($posts as $post) : ?>
      <div class="blog-post-comment">

        <div class="blog-post">
          <div class="blog-post__img">
            <img <?php echo 'src="data:image/jpeg;base64,' . base64_encode($post['imagem']) . '"' ?>>
          </div>
          <div class="blog-post__info">
            <div class="blog-post__date">
              <span><?php echo date('F j, Y', strtotime($post['data'])); ?></span>
            </div>
            <h1 class="blog-post__title"><?php echo $post['title']; ?></h1>
            <p class="blog-post__text">
              <?php echo $post['text']; ?>
            </p>
            <a href="javascript:;" id="comentar" class="blog-post__cta" style="text-decoration : none; color : rgba(0,0,0,.7);">Comentar</a>

            <form action="comentario.php?postId=<?php echo $post['POST_ID'] ?>" method="post">
              <div id="comment_form_wrapper" style="display: none;">
                <input type="text" name="comentario" class="form-control rounded-corner" placeholder="Escreve um comentário...">
                <span class="input-group-btn p-l-10">
                  <input class="btn btn-primary f-s-12 rounded-corner" value="Submeter" id="submit" type="submit">
                </span>
              </div>
            </form>

            <script type="text/javascript">
              $(document).ready(function() {
                $('#comentar').click(function() {
                  $('#comment_form_wrapper').toggle();
                });
              });
            </script>

          </div>

        </div>

        <div class="blog-post__comment">

          <?php

          $postid = $post['POST_ID'];

          $com_query = "SELECT * FROM comentarios WHERE POST_ID='$postid'";
          $com_result = mysqli_query($mysqli, $com_query) or die(mysqli_error($mysqli));
          $resultCheck = mysqli_num_rows($com_result);

          if ($resultCheck > 0) {
            while ($com = mysqli_fetch_assoc($com_result)) {
              $comentarios[] = $com;
              $nocomments = 0;
            }
          } else {
            $nocomments = 1;
          }

          ?>

          <h1 class="blog-post__title">Comentários:</h1>
        
          
          <p class="blog-post__text">

            <?php if ($nocomments == 0) foreach ($comentarios as $comentario):
              $user_com = $comentario['ID_USER'];

              $user_query = "SELECT nome FROM utilizadores WHERE user_id='$user_com'";
            
              $user_result = mysqli_query($mysqli, $user_query) or die(mysqli_error($mysqli));

              while ($un = mysqli_fetch_assoc($user_result)) {
                $username_com = $un;
              } ?>

              <hr>
              <p> <?php echo $comentario['COMENTARIO']; ?> </p>
            
              <b>Publicado por:</b>
              <?php echo $username_com['nome']; ?>
                <hr>

              <?php endforeach; ?>

              <?php if ($nocomments == 1) : ?>
                Ainda ninguém comentou esta publicação :(
              <?php endif; ?>

          </p>
        </div>
      </div>
    <?php endforeach; ?>

  </div>

</body>

</html>