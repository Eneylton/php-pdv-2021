<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;


class Cliente{
    

    public $id;
    public $nome;
    public $email;
    public $telefone;
    public $placa;
    public $usuarios_id;
    


    
    public function cadastar(){


        $obdataBase = new Database('clientes');  
        
        $this->id = $obdataBase->insert([
          
            'nome'            => $this->nome, 
            'email'           => $this->email, 
            'telefone'        => $this->telefone, 
            'placa'           => $this->placa, 
            'usuarios_id'      => $this->usuarios_id
            
        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('clientes'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getRelacinadas($where = null, $order = null, $limit = null){

    return (new Database ('clientes'))->relacionadas($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}


public static function getBaixoEstoque($where = null, $order = null, $limit = null){

    return (new Database ('clientes'))->baixo($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public function atualizarPedidos(){
    return (new Database ('clientes'))->update('id = ' .$this-> id, [
 
                                                'valor_compra'      => $this->valor_compra
    ]);
  
}


public static function getQtd($where = null){

    return (new Database ('clientes'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}



public static function qtdCount($where = null){

    return (new Database ('clientes'))->qtd($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}

public static function qtdCountBaixo($where = null){

    return (new Database ('clientes'))->qtdBaixo($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getQtdReal($where = null){

    return (new Database ('clientes'))->relacionadas($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;
}


public static function getID($id){
    return (new Database ('clientes'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('clientes'))->update('id = ' .$this-> id, [

        'nome'            => $this->nome, 
        'email'           => $this->email, 
        'telefone'        => $this->telefone, 
        'placa'           => $this->placa, 
        'usuarios_id'      => $this->usuario_idusuarios_id 

    ]);
  
}




public function excluir(){
    return (new Database ('clientes'))->delete('id = ' .$this->id);
  
}


public static function getPdf(){

    return (new Database ('clientes'))->pdf($where = null)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}



}