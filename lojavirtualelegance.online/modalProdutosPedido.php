           <div class="modal fade" id="modalProdutos" role="dialog">
                <div class="modal-dialog modal-lg centerModal">

                    <!-- Conteúdo -->
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Detalhes do Pedido</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body fonteRoboto">


                             <h5>Dados do cliente</h5>

                            <div id="dadosCliente">
                           
                            <div class="row">
                                <div class="col-md-6">
                                        <label>Nome: <?php echo $dados->nome; ?></label>
                                        
                                </div>
                                <div class="col-md-6">
                                        <label>CPF: <?php echo $dados->cpf; ?></label>
                                </div>

                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                            <label>E-mail: <?php echo $dados->email; ?></label>
                                    </div>
                                    <div class="col-md-6">
                                            <label>Telefone: <?php echo $dados->telefone; ?></label>
                                    </div>
    
                                </div>
                            </div>
                               <br><br>
                               <h5>Produtos</h5>
                               <?php
                               $arrayProdutos = null;
                               $conn = conectaAoMySQL();
                               $caminho = "imagens/";
                               if ($arrayPedidos != ""){
                               foreach ($arrayPedidos as $pedido){
                                   $id = $pedido->idPedido;
                                   $arrayProdutos = getProdutosPedido($conn, $id);
                                   foreach ($arrayProdutos as $produto){
                                      $img = $caminho . $produto->foto;
                                       echo "
                                        <div class='row'>

                                        <div class='col-md-3'>
                                        <img src='$img' width='150' height='150'>
                                       </div>
                                       <div class='col-md-9'>
                                           <table class='table'>
                                               <thead>
                                                   <tr>
                                                       <th>Produto</th>
                                                       <th>Descrição</th>
                                                       <th>Preço</th>
       
                                                   </tr>
                                               </thead>
                                               <tbody>
                                               <tr>
                                                   <td>$produto->nome</td>
                                                   <td>$produto->descricao</td>
                                                   <td class='text-info'>R$ $produto->preco</td>
                                               </tr>
   
                                           </tbody>
                                       </table>
                                        </div>
                                        </div> ";
                                   }
                               }
                            }

                             ?>
                          


                        </div>
                    </div>

                

                </div>

            </div>