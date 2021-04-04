<?php

$listProdutos = '';

foreach ($produtos as $item) {

  $listProdutos .= '

                <tr>
                  <td>   
                            
                        <div class="icheck-red ">
                        <input type="checkbox" value="' . $item->id . '" name="id[]" id="[' . $item->id . ']">
                        <label for="[' . $item->id . ']"></label>
                        </div>   
                        </td>
                                
                        <td>
                        
                        <div class="product-img">
                        <img src="' . $item->estoque = '' ? 'imgs/sem.jpg' : $item->foto . '" class="img-size-50" class="img-thumbnail">
                        </div>
                        </td>
                        <td>' . $item->codigo . '</td>
                        <td>' . $item->nome . '</td>
                        <td style="text-align:center">
                      
                        <span style="font-size:16px" class="' . ($item->estoque <= 3 ? 'badge badge-danger' : 'badge badge-success') . '">' . $item->estoque . '</span>
                        
                        </td>
                        <td> R$ ' . number_format($item->valor_venda, "2", ",", ".") . '</td>
                        <td>

                        <a href="#">
                         <i class="fas fa-plus-circle" style="font-size:38px;color:#e1e1e1"></i>
                       </a>
                        
                  </td>
                </tr>

';
}


?>


<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= TITLE ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Atendente:</a></li>
            <li class="breadcrumb-item active"><?= $usuario ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-8 col-6">

          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">
                <form method="get">
                  <div class="input-group input-group-sm" style="width: 300px;">

                    <input type="text" name="buscar" class="form-control float-right" placeholder="Pesquisar...." >

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </h3>


            </div>
            <form id="form1" action="?" method="post">
              <div class="card-header">
                <ul class="pagination pagination-sm float-right">
                  <button type="submit" name="submit" class="btn btn-warning" style="margin-top:-20px;" disabled>
                    Adicionar Todos
                    &nbsp; <i class="fas fa-chevron-right"></i>
                  </button>
                </ul>

              </div>

              <div class="card-body">


                <div class="tab-content p-0 direct-chat-messages" style="height: 450px; margin-top:-30px">
                  <table class="table table-hover table-dark">
                    <thead>
                      <tr>
                        <th>
                          <div class="icheck-warning d-inline">
                            <input type="checkbox" id="select-all">
                            <label for="select-all">
                            </label>
                          </div>

                        </th>
                        <th>IMAGEM</th>
                        <th>CÓDIGO</th>
                        <th>PRODUTO</th>
                        <th style="text-align:center">ESTOQUE</th>
                        <th>VALOR</th>
                        <th>AÇÃO</th>

                      </tr>
                    </thead>
                    <tbody>

                      <?= $listProdutos  ?>


                    </tbody>
                  </table>
                </div>
              </div>
          </div>


          </form>

        </div>

        <div class="col-lg-4 col-6">
          
          <div class="small-box bg-warning">
            <div class="inner">
              <h3> R$ <?= number_format($total_obra, "2", ",", ".") ?></h3>

              <p>Total da venda</p>
              <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
              <hr>
              <form action="venda.php" method="POST">

              <input type="hidden" name="mecanico_id" value="<?=$mecanico_id  ?>">
              <input type="hidden" name="servico " value="<?=$servico?>">
              <input type="hidden" name="clientes_id" value="<?=$clientes_id  ?>">
              <input type="hidden" name="total_obra"  value="<?=$total_obra ?>">

              <div class="modal-body">
              
              <div class="form-group">
                <label>Valor Recebido</label>
                <input class="form-control form-control-lg" placeholder="Digite..." value="<?=$total_obra ?>" name="valor_recebido" required autofocus></input>
              </div>

              <div class="form-group">
                      <label>Forma de Pagamento</label>
                      <select class="form-control form-control-lg" name="form_pagamento" required>
                        <option value="">Selecione a forma de Pagamento</option>
                        <option value="Dinheiro">Dinheiro</option>
                        <option value="Cartão de Débito">Cartão de Débito</option>
                        <option value="Cartão de Crédito">Cartão de Crédito</option>
                      </select>
             </div>
             

           
            <button type="submit" class="btn btn-danger btn-lg btn-block">FINALIZAR</button>
          </div>
      </form>
              
        </div>

      </div>
    </div>

    <!-- MODAL -->
    <form action="pdv.php" method="post">


      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Novo Cliente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Nome</label>
                <input class="form-control" rows="2" placeholder="Digite..." name="nome" required></input>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" rows="2" placeholder="Digite..." name="email"></input>
              </div>
              <div class="form-group">
                <label>Telefone</label>
                <input class="form-control" rows="2" placeholder="Digite... " name="telefone"></input>
              </div>

              <div class="form-group">
                <label>Placa</label>
                <input class="form-control" rows="2" placeholder="Digite..." name="placa"></input>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </div>
        </div>
      </div>
    </form>