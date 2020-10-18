<?php

//importar a clase:
require_once('Produto.php');
require_once('ProdutoDAO.php');


$dao = new ProdutoDAO();
//$dao->inserir(new Produto(0, "Xiaomi", 310));
//$dao->inserir(new Produto(2, "Juliano Cudoconde", 30));
//$dao->inserir(new Produto(3, "Ana Banana", 40));
//$dao->inserir(new Produto(103, "Andrews Cagaião", 20));

$dao->atualizar(4, new Produto("", "Fone", 2));

//$dao->deletar(5);

//print_r($dao->buscarId(1));

print_r($dao->listar());

?>