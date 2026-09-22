<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$livros = [
    ['id' => 1, 'nome' => '1984'],
    ['id' => 2, 'nome' => 'Memorias Póstumas de Brás Cubas'],
    ['id' => 3, 'nome' => 'A Revolução dos Bichos'],
];

$app->get('/status', function ($request, $response) {
    $response->getBody()->write(
        json_encode(['status' => 'ok'])
    );

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->get('/status/xml', function ($request, $response) {
    $response->getBody()->write(
        '<status>ok</status>'
    );

    return $response
        ->withHeader('Content-Type', 'application/xml')
        ->withStatus(200);
});

$app->get('/status/plain', function ($request, $response) {
    $response->getBody()->write(
        'Status: ok'
    );

    return $response
        ->withHeader('Content-Type', 'text/plain')
        ->withStatus(200);
});

$app->get('/livros/{id}', function ($request, $response, $args) use (&$livros) {

    $id = (int) $args['id'];

    foreach ($livros as $livro) {
        if ($livro['id'] === $id) {

            $response->getBody()->write(
                json_encode($livro)
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    }

    $response->getBody()->write(
        json_encode(['erro' => 'Livro não encontrado'])
    );

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(404);
});

$app->post('/livros', function ($request, $response) use (&$livros) {

    $dados = $request->getParsedBody();

    if (!isset($dados['nome']) || empty($dados['nome'])) {

        $response->getBody()->write(
            json_encode(['erro' => 'O nome é obrigatório'])
        );

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    }

    $novoLivro = [
        'id' => count($livros) + 1,
        'nome' => $dados['nome']
    ];

    $livros[] = $novoLivro;

    $response->getBody()->write(
        json_encode($novoLivro)
    );

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(201);
});

$app->put('/livros/{id}', function ($request, $response, $args) use (&$livros) {

    $id = (int) $args['id'];
    $dados = $request->getParsedBody();

    foreach ($livros as &$livro) {

        if ($livro['id'] === $id) {

            if (isset($dados['nome']) && !empty($dados['nome'])) {
                $livro['nome'] = $dados['nome'];
            }

            $response->getBody()->write(
                json_encode($livro)
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    }

    $response->getBody()->write(
        json_encode(['erro' => 'Livro não encontrado'])
    );

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(404);
});

$app->delete('/livros/{id}', function ($request, $response, $args) use (&$livros) {

    $id = (int) $args['id'];

    foreach ($livros as $indice => $livro) {

        if ($livro['id'] === $id) {

            unset($livros[$indice]);

            return $response->withStatus(204);
        }
    }

    $response->getBody()->write(
        json_encode(['erro' => 'Livro não encontrado'])
    );

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(404);
});

$app->run();