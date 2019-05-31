<?php
    use Slim\App;
    use Slim\Http\Request;
    use Slim\Http\Response;
    Use App\Models\Produto;
    Use App\Models\Usuario;
    Use \Firebase\JWT\JWT;

    /*
        Site cliente -> Acessar API -> (Site, app...)

        API.nicolas
            Cadastro
            Email, senha
            Gerar -> Token
        Recuperar -> Token
    */

    //Rotas para geração de token
    $app->post('/api/token', function($request, $response){
        $dados = $request->getParsedBody();

        $email = $dados['email'] ?? null;
        $senha = $dados['senha'] ?? null;

        $usuario = Usuario::where('email', $email)->first();

        if(!is_null($usuario) && (md5($senha) === $usuario->senha)){
            //Gerar token
            /*
                id_usuario 1
                Token: hasufh318290sahdsuo8023u1
                //Expira: 25/08/20
            */
            $secretKey = $this->get('settings')['secretKey'];
            $chaveAcesso = JWT::encode($usuario, $secretKey);

            return $response->withJson([
                'chave' => $chaveAcesso
            ]);
        }
        return $response->withJson([
            'status' => 'erro'
        ]);
    });