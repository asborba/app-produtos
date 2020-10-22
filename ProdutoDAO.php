<?php

require_once('Produto.php');

class ProdutoDAO {
    private $pdo;

    public function __construct() {
        //conexão com o banco
        $servername = "localhost";
        $username = "root";
        $password = "";
        $databasename = "crud_produtos";

        try {
        $this->pdo = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        // set the PDO error mode to exception
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


//INSERIR
function inserir(Produto $produto) {
    try {
        $stmt = $this->pdo->prepare("INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)");
        $stmt->bindParam(':nome', $produto->getNome());
        $stmt->bindParam(':preco', $produto->getPreco());
        $stmt->execute();
    }
    
    catch(PDOException $e) {
        echo "Statement failed: " . $e->getMessage();
    
    }
    
}

//LISTAR
function listar() {
    $listaProdutos = array();

    try {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos");
        $stmt->execute();

        $listaProdutos = $stmt->fetchAll(
            //fetch_props chama o construtor 1º e depois atribui os valores do banco
           PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
           return $listaProdutos;
   }

    catch(PDOException $e) {
       echo "Statement failed: " . $e->getMessage();
    }
}


//BUSCAR POR ID
function buscarId($id) {
    $q = "SELECT * FROM produtos WHERE id=:id";
    $comando = $this->pdo->prepare($q);
    $comando->bindParam(":id", $id);
    $comando->execute();
    $comando->setFetchMode(PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
    $obj = $comando->fetch();
    return($obj);
}


//DELETAR
function deletar($id) {
    $qdeletar = "DELETE FROM produtos WHERE id=:id";
    $comando = $this->pdo->prepare($qdeletar);
    $comando->bindParam(':id', $id);
    $comando->execute();
}


//ATUALIZAR
function atualizar($id, Produto $produtoAlterado) {
    $qAtualizar = "UPDATE produtos SET nome=:nome, preco=:preco WHERE id=:id";
    $comando = $this->pdo->prepare($qAtualizar);
    

    $comando->bindValue(":nome", $produtoAlterado->getNome());
    $comando->bindValue(":preco", $produtoAlterado->getPreco());
    $comando->bindParam(":id", $id);
    $comando->execute();
}

}

?>