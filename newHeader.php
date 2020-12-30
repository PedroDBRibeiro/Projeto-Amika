

<nav class="navbar navbar-expand-lg navbar-light bg-light">

<a href="Homepage.php">
<img src="Imagens\LogoAmika.png" alt="Logo Amik@"  style="width:20%;"></img>
</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <?php 
        if(isset($_SESSION['loggedin'])){
                ?> 
        <a  class="nav-link" href="profile.php?search_result=<?php echo $_SESSION['user_id']; ?>" style="text-decoration:none;"> 
        <img src="imagens\profile.png" alt="Profile Icon" width="30" height="30" class="d-inline-block align-top"></img>
        Perfil   
        </a>

        <?php } ?>
      </li>
      <li class="nav-item ">
                    <?php 
                            if(isset($_SESSION['loggedin'])){
                        ?> 
                                    <a  class="nav-link" href="logout.php" style="text-decoration:none;">
                                      <img src="imagens\Logout.png" alt="Logout Icon" width="30" height="30" class="d-inline-block align-top"></img>
                                        Sair
                                    </a>
                        <?php }

                        else{ ?> <!-- data-toggle="modal" data-target="#myModal"-->
                        <a   class="nav-link" data-toggle="modal" data-target="#myModal"  style="width:auto;" style="text-decoration:none;">
                            <img src="imagens\login.png" alt="Login Icon" width="30" height="30" class="d-inline-block align-top"></img>
                            Entrar
                        </a>
                        <?php 
                            } 
                        ?>  
      </li>
    </ul>
  </div>
</nav>



