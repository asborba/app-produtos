<?php

class Produto {
    private $id;
    private $nome;
    private $preco;

    // pra inicializar a classe, precisa de um construtor
    public function __construct($id, $nome, $preco) {
        
        //atribuir o id da classe ao id do construct
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
    }

    // GETS
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }


    // SETS - permite alteração depois do objeto
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }
    
}

?>