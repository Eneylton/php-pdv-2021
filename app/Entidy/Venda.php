<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;


class Venda{
    

    public $id;
    public $nome;
    public $valor;
    public $valor_recebido;
    public $qtd;
    public $subtotal;
    public $total;
    public $produtos_id;
    public $clientes_id;
    
    
    public function cadastar(){


        $obdataBase = new Database('vendas');  
        
        $this->id = $obdataBase->insert([
          
            'nome'                  => $this->nome, 
            'valor'                 => $this->valor, 
            'valor_recebido'        => $this->valor_recebido, 
            'qtd'                   => $this->qtd, 
            'subtotal'              => $this->subtotal,
            'total'                 => $this->total,
            'produtos_id'           => $this->produtos_id,
            'clientes_id'           => $this->clientes_id
            
        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('vendas'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getRelacinadas($where = null, $order = null, $limit = null){

    return (new Database ('vendas'))->relacionadas($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}


public static function getBaixoEstoque($where = null, $order = null, $limit = null){

    return (new Database ('vendas'))->baixo($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public function atualizarPedidos(){
    return (new Database ('vendas'))->update('id = ' .$this-> id, [
 
                                                'valor_compra'      => $this->valor_compra
    ]);
  
}


public static function getQtd($where = null){

    return (new Database ('vendas'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}



public static function qtdCount($where = null){

    return (new Database ('vendas'))->qtd($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}

public static function qtdCountBaixo($where = null){

    return (new Database ('vendas'))->qtdBaixo($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getQtdReal($where = null){

    return (new Database ('vendas'))->relacionadas($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;
}


public static function getID($id){
    return (new Database ('vendas'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('vendas'))->update('id = ' .$this-> id, [

        'nome'                  => $this->nome, 
        'valor'                 => $this->valor, 
        'valor_recebido'        => $this->valor_recebido, 
        'qtd'                   => $this->qtd, 
        'subtotal'              => $this->subtotal,
        'total'                 => $this->total,
        'produtos_id'           => $this->produtos_id,
        'clientes_id'           => $this->clientes_id
    ]);
  
}




public function excluir(){
    return (new Database ('vendas'))->delete('id = ' .$this->id);
  
}


public static function getPdf(){

    return (new Database ('vendas'))->pdf($where = null)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}



}