<div class="modal fade" id="myModal" role="dialog">
           
           
            <div class="modal-dialog">

                <!-- Conteúdo -->
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Itens adicionados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div id="modalCarrinho" class="modal-body">


            
                    </div>

                    <div class="modal-footer">
                    <?php
                    
                    if(isset($_SESSION['cpfCliente'], $_SESSION['email'], $_SESSION['senha'] )){
                      echo "<a href=concluirpedido.php><button type='button' class='btn btn-md estilo'>Concluir Compra</button></a>";
                    }
                    else{
                      echo "<a href=login.php><button type='button' class='btn btn-md estilo'>Concluir Compra</button></a>";
                    }
                    ?>
                    </div>
           
                </div>

			</div>
			
		</div>
