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
        <form action="gerar-pdf.php" method="POST">
          <input type="hidden" name="troco" value="<?= $troco ?>">
          <div class="small-box bg-success">
            <div class="inner">
               <?php

               if(empty($msn)){


               }else{

                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>ATENÇÃO: </strong> '.$msn.'
                <a href="finalizar.php" >
                <button type="submit" class="btn btn-warning"  >
                  Voltar
                </button>
                </a>
              </div> ';
               }

              ?>
              <h3>TROCO: R$ <?= number_format($troco, "2", ",", "."); ?> </h3>

              <p>Valor á pagar.....</p>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <hr>
             


                <button type="submit" class="btn btn-warning btn-lg btn-block">RECIBO</button>
            </div>

          </div>

        </form>
        </div>
      </div>
