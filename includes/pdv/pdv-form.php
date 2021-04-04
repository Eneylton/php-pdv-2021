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

                        <a href="?acao=add&id=' . $item->id . '">
                         <i class="fas fa-plus-circle" style="font-size:38px;color:#30da04"></i>
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

                    <input type="text" name="buscar" class="form-control float-right" placeholder="Pesquisar...." autofocus>

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
                  <button type="submit" name="submit" class="btn btn-warning" style="margin-top:-20px;">
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
          <?php

          use   \App\Entidy\Produto;


          if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
          }

          $resultado = '';
          $total = 0;


          if (isset($_GET['acao'])) {

            if ($_GET['acao'] == 'add') {
              $id = intval($_GET['id']);

              if (!isset($_SESSION['carrinho'][$id])) {

                $_SESSION['carrinho'][$id] = 1;
              } else {
                $_SESSION['carrinho'][$id] += 1;
              }
            }

            if ($_GET['acao'] == 'up') {

              if (is_array($_POST['prod'])) {

                foreach ($_POST['prod'] as $id => $qtd) {

                  $id = intval($id);
                  $qtd = intval($qtd);

                  if (!empty($qtd) || $qtd != 0) {

                    $_SESSION['carrinho'][$id] = $qtd;
                  } else {

                    unset($_SESSION['carrinho'][$id]);
                  }
                }
              }

              if (is_array($_POST['val'])) {

                foreach ($_POST['val'] as $id => $preco) {

                  $item = Produto::getID($id);

                  $item->valor_venda = $preco;
                  $item->atualizar();
                }
              }
            }

            if ($_GET['acao'] == 'del') {
              $id = intval($_GET['id']);

              if (isset($_SESSION['carrinho'][$id])) {
                unset($_SESSION['carrinho'][$id]);
              }
            }
          }

          // ADICONAR

          if (isset($_POST['submit'])) {

            if (isset($_POST['id'])) {

              foreach ($_POST['id'] as $id) {

                if (isset($_POST['id'])) {

                  $id  = intval($id);

                  if (!isset($_SESSION['carrinho'][$id])) {

                    $_SESSION['carrinho'][$id] = 1;
                  } else {

                    $_SESSION['carrinho'][$id] += 1;
                  }
                }
              }
            }

            $_SESSION['dados'] = array();

            foreach ($_SESSION['carrinho'] as $id => $qtd) {

              $item = Produto::getID($id);

              $nome = $item->nome;

              $valor_venda = $item->valor_venda;

              $qtd;

              $sub = $qtd * $item->valor_venda;

              $total += $sub;

              array_push(
                $_SESSION['dados'],
    
                array(
                    'nome'                => $nome,      
                    'valor'               => $valor_venda,      
                    'qtd'                 => $qtd,      
                    'subtotal'            => $sub,      
                    'produtos_id'         => $id
                )
            );


              $resultado .= ' 
                      
                  <tr>
                    
                    <td style="text-transform:uppercase; font-size:small">' . $nome . '</td>
              
                    <td style="width:80px">
              
                    <input type="text" size="1" name="prod[' . $id . ']" value="' . $qtd . '" style="width:50px" />
              
                   
                    
                    </td>
              
                    <td style="width:150px">R$
              
                    <input type="text" size="3" name="val[' . $id . ']" value="' . $item->valor_venda . '" />
              
                    <button type="submit" ><i class="fas fa-pen"></i></button>
                     
                    &nbsp;&nbsp;
              
                    <a href="?acao=del&id=' . $id . '"
                  
                    <i class="fas fa-times" style="color:#ff0000"></i>
                    </a>
                    
                    </td>
                    <td> R$ ' . number_format($sub, "2", ",", ".") . '</td>
              
                    
                    </tr>
                  
                  
                  ';
            }
          }


          ?>

          <div class="small-box bg-danger">
            <div class="inner">
              <h3> R$ <?= number_format($total, "2", ",", ".") ?></h3>

              <p>Total de compras</p>
              <hr>

              <!-- TABLE -->

              <div class="tab-content p-0 direct-chat-messages" style="height: 250px;">

                <table class="table table-hover table-dark table-striped table-sm">
                  <thead>
                    <tr>
                      <th> PRODUTO </th>
                      <th> QTD </th>
                      <th style="width:200px"> VALOR </th>
                      <th style="width:100px"> SUBTOTAL </th>
                    </tr>
                  </thead>
                  <tbody>
                    <form action="?acao=up" method="post">
                      <?= $resultado ?>
                    </form>
                  </tbody>
                </table>

              </div>

              <!-- FIM -->

              <!-- FORMULÁRIO -->

              <form action="finalizar.php" method="post">
                <div class="row">
                  <div class="col-sm-4">

                    <div class="form-group">
                      <label>Mecânico</label>
                      <select class="form-control form-control-lg" name="mecanico_id" required>
                        <option value="">Selecione</option>
                        <?php
                        $option = '';
                        foreach ($clientes as $item) {
                          echo '<option value="' . $item->id . '">' . $item->nome . '</option>';
                        }
                        ?>
                      </select>


                    </div>


                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Cliente</label>
                      <select class="form-control form-control-lg" name="clientes_id" required>
                        <option value="">Selecione</option>
                        <?php
                        $option = '';
                        foreach ($clientes as $item) {
                          echo '<option value="' . $item->id . '">' . $item->nome . '</option>';
                        }
                        ?>
                      </select>
                    </div>

                  </div>

                  <div class="col-sm-2">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-top:37px">
                      <i class="fas fa-plus"></i>
                    </button>

                  </div>

                  <div class="col-sm-8">

                    <div class="form-group">
                      <label>Serviços</label>
                      <select class="form-control form-control-lg" name="servico" required>
                        <option value="">Selecione um Serviço</option>
                        <option value="Limpeza de Motor">Limpeza de Motor</option>
                        <option value="Limpeza de Bico">Limpeza de Bico</option>
                        <option value="Serviços Mecânicos">Serviços Mecânicos</option>
                      </select>
                    </div>

                  </div>
                  <div class="col-sm-4">

                    <div class="form-group">
                      <label>Mão de Obra</label>
                      <input class="form-control form-control-lg" placeholder="Digite..." name="obra"></input>
                    </div>

                  </div>
                </div>
            

              <!-- FIM -->


            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <button type="submit" class="btn btn-success btn-lg btn-block">ENVIAR</button>
          </div>
        </div>

      </div>
    </div>
    </form>
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