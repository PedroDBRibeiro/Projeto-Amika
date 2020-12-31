
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
            
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">ENTRAR</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
               
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form class="modal-content animate" action ="chat/login.php" method="POST">
                                <div class="container"> 
                                    <label for="emailLogin"><b>Email</b></label>
                                        <input type="text" placeholder="Inserir Email" name="email" required>

                                    <label for="pswLogin"><b>Palavra-Passe</b></label>
                                        <input type="password" placeholder="Inserir Palavra-passe" name="password" required>

                                    <button type="submit" name ="login" value ="Login">Entrar</button>
                                    <label>
                                        <input type="checkbox" checked="checked" name="remember"> Lembrar-me
                                    </label>
                                    <a style="text-decoration:underline;" href="PaginaRegisto.php"><br>Inscrever-me</a>
                                    
                                </div>
                        </form> 
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                
                
                </div>
            </div>
        </div>
        
        