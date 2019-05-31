<?php
    use Slim\App;
    use Slim\Http\Request;
    use Slim\Http\Response;
    Use App\Models\Produto;

    //Routes
    $app->group('/api/v1', function(){
        //Lista produtos
        $this->get('/produtos/lista', function($request, $response){
            $produtos = Produto::get();
            return $response->withJson($produtos);
        });
        //Adiciona um produto
        $this->post('/produtos/adiciona', function($request, $response){
            $dados = $request->getParsedBody();
            $produtos = Produto::create($dados);
            return $response->withJson($produtos);
        });
        //Recupera um produto para um determinado ID
        $this->get('/produtos/lista/{id}', function($request, $response, $args){
            $produtos = Produto::findOrFail($args['id']);
            return $response->withJson($produtos);
        });
        //Atualiza produto para um determinado ID
        $this->put('/produtos/atualiza/{id}', function($request, $response, $args){
            $dados = $request->getParsedBody();
            $produtos = Produto::findOrFail($args['id']);
            $produtos->update($dados);
            return $response->withJson($produtos);
        });
        //Remove produto para um determinado ID
        $this->delete('/produtos/remove/{id}', function($request, $response, $args){
            $produtos = Produto::findOrFail($args['id']);
            $produtos->delete();
            return $response->withJson($produtos);
        });
    });