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

$troco = 0;
$msn = '';
if(isset($_POST['mecanico_id'], $_POST['clientes_id'])){
 
 $mecanico = $_POST['mecanico_id'];
 $servico = $_POST['servico_'];
 $clientes_id = $_POST['clientes_id'];
 $total_obra = $_POST['total_obra'];
 $valor_recebido = $_POST['valor_recebido'];

 if($total_obra >= $valor_recebido){

  $msn .='Esse valor é menor que o valor da compra !!!!!';

}else{
   
   $troco = ($valor_recebido - $total_obra);

   foreach ($_SESSION['dados'] as $key) {

   $item = new Venda;
                 
   $item->nome              = $key['nome'];
   $item->valor             = $key['valor'];
   $item->qtd               = $key['qtd'];
   $item->subtotal          = $key['subtotal'];
   $item->produtos_id       = $key['produtos_id'];
   $item->form_pagamento    = $_POST['form_pagamento'];
   $item->valor_recebido    = $_POST['valor_recebido'];
   $item->total             = $total_obra;
   $item->clientes_id       = $_POST['clientes_id'];

   $item-> cadastar();

  
 }

//  unset($_SESSION['dados']);
//  unset($_SESSION['carrinho']);
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
include __DIR__ . '/includes/pdv/venda-form.php';
include __DIR__ . '/includes/footer.php';
