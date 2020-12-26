<header>
            <table class="tabelaHeader" >
                <tr>
                    <th>

                <?php 
                   if(isset($_SESSION['loggedin'])){
         ?> 
                        <a  href="Profile.php" style="text-decoration:none;"> 
                            <img src="imagens\profile.png" alt="Profile Icon" class="IconHeader"></img>
                            <p class="hyperlink">PERFIL</p> 
                        </a>
                        <?php }
                    else{ ?>                                  
                <?php 
                    }       
                    ?>
                    </th>
                    <th>
                        <a href="Homepage.php">
                        <img src="Imagens\LogoAmika.png" alt="Logo Amik@" class="logoAmika"></img>
                        </a>
                    </th>
                    <th>
                    
                   <!-- <a  href="homepage.php" style="text-decoration:none;"> 
                        <img src="imagens\home.png" alt="Home Icon" class="IconHeader"></img>
                        <p class="hyperlink">MENU</p> 
                    </a>
                    -->                     
                    </th>
                    <th>
                        <?php 
                            if(isset($_SESSION['loggedin'])){
                        ?> 
                                    <a  href="logout.php" style="text-decoration:none;">
                                        <img src="imagens\Logout.png" alt="Logout Icon" class="IconHeader"></img>
                                        <p class="hyperlink">SAIR</p> 
                                    </a>
                        <?php }

                        else{ ?> <!-- data-toggle="modal" data-target="#myModal"-->
                        <a   data-toggle="modal" data-target="#myModal"  style="width:auto;" style="text-decoration:none;">
                            <img src="imagens\login.png" alt="Login Icon" class="IconHeader"></img>
                            <p class="hyperlink">ENTRAR</p> 
                        </a>
                        <?php 
                            } 
                        ?>                      
                    </th>
                </tr>
            </table>
        </header>