<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require_once 'Produto.php';
require_once 'ProdutoDAO.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();


// BUSCAR POR ID
$app->get('/produtos/{id}',
    function(Request $request, Response $response, $args) {

        $id = $args['id'];
        $dao = new ProdutoDAO();

        $data = $dao->buscarId($id);
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

);


// LISTAR PRODUTOS
$app->get('/produtos',
    function(Request $request, Response $response, $args) {
        
        $dao = new ProdutoDAO();
        
        $data = $dao->listar();
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json');
    }
);



// INSERIR PRODUTO
$app->post('/produtos',
    function (Request $request, Response $response, array $args) {

        $data = $request->getParsedBody();
        $produto = new Produto(0, $data['nome'], $data['preco']);

        $dao = new ProdutoDAO();
        $data = $dao->inserir($produto);
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
    }

);



// ATUALIZAR PRODUTO
$app->put('/produtos/{id}',
    function (Request $request, Response $response, $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $produto = new Produto($id, $data['nome'], $data['preco']);

        $dao = new ProdutoDAO();
        $produto =$dao->atualizar($id, $produto);

        $payload = json_encode($produto);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);    
    }
);



// DELETAR PRODUTO
$app->delete('/produtos/{id}',
    function(Request $request, Response $response, $args) {

        $id = $args['id'];
        $dao = new ProdutoDAO();

        $produto = $dao->deletar($id);
        $payload = json_encode($produto);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
);



// SEI LÁ A INTRO
$app->get('/',
    function(Request $request, Response $response, $args) {
        $response->getBody()->write("Hello World!");
        return $response;
    }
);

$app->run();

?>