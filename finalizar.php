<?php

require __DIR__ . '/vendor/autoload.php';

use   \App\Entidy\Venda;
use    \App\Entidy\Produto;
use     \App\Db\Pagination;
use      \App\Session\Login;


define('TITLE', 'Finalizar Compra');
define('BRAND', 'Caixa ');

Login::requireLogin();

// USUARIO-LOGADO

$usuariologado = Login::getUsuarioLogado();

$usuario = $usuariologado['nome'];
$usuarios_id = $usuariologado['id'];

if(isset($_POST['servico'], $_POST['obra'])){
 
$mecanico_id = $_POST['mecanico_id'];
$clientes_id  = $_POST['clientes_id'];
$servico     = $_POST['servico'];
$obra        = $_POST['obra'];
}

$total_obra = 0;
$troco = 0;
$soma  = 0;

if(isset($_SESSION['dados'])){

        if(isset($clientes_id)){

          foreach ($_SESSION['dados'] as $key) {

            $item = new Venda;
            $item->subtotal  = $key['subtotal'];
           

            $soma += $item->subtotal;

    }

 }

        if(isset($obra)){

          $total_obra = $soma + $obra;

        }else{
        
          if(isset($_POST['valor_recebido'], $_POST['form_pagamento'])){
 
            foreach ($_SESSION['dados'] as $key) {

             if($_POST['valor_recebido'] < $_POST['valor_obra']){
               
              $msn = '';

             }else{

              $item = new Venda;
                 
              $item->nome              = $key['nome'];
              $item->valor             = $key['valor'];
              $item->qtd               = $key['qtd'];
              $item->subtotal          = $key['subtotal'];
              $item->produtos_id       = $key['produtos_id'];
              $item->form_pagamento    = $_POST['form_pagamento'];
              $item->valor_recebido    = $_POST['valor_recebido'];
              $item->total             = $_POST['valor_obra'];
              $item->clientes_id       = $_POST['clientes_id'];

              $item-> cadastar();
                
            }

            $troco = $item->total - $item->valor_recebido ;
          

        }

      }
   }
      
}

// LISTAR PRODUTOS
      
$buscar = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_STRING);

$condicoes = [
  strlen($buscar) ? 'p.nome LIKE "%' . str_replace(' ', '%', $buscar) . '%" 
                       or 
                       p.codigo LIKE "%' . str_replace(' ', '%', $buscar) . '%"
                       or 
                       c.nome LIKE "%' . str_replace(' ', '%', $buscar) . '%"
                       or 
                       p.barra LIKE "%' . str_replace(' ', '%', $buscar) . '%"
                       or 
                       p.data LIKE "%' . str_replace(' ', '%', $buscar) . '%"' : null
];

$condicoes = array_filter($condicoes);

$where = implode(' AND ', $condicoes);

$qtd = Produto::qtdCount($where);

$pagination = new Pagination($qtd, $_GET['pagina'] ?? 1, 200);

$produtos = Produto::getRelacinadas($where, 'nome ASC', $pagination->getLimit());

// FIM



include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/top.php';
include __DIR__ . '/includes/menu.php';
include __DIR__ . '/includes/pdv/finalizar-form.php';
include __DIR__ . '/includes/footer.php';
