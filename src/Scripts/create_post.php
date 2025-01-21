<?php

require_once __DIR__ . '/../../bootstrap.php';

function addPost($userId, $title, $content): void
{
    global $entityManager;

    //Verifica se o usuário com id informado existe no banco
    $user = $entityManager->getRepository(\App\Entities\User::class)->find($userId);
    if (!$user) {
        echo "Usuário não encontrado.\n";
        exit(1);
    }

    //Cria o novo post, vinculando ao usuário encontrado
    $post = new \App\Entities\Post();
    $post->setTitle($title);
    $post->setContent($content);
    $post->setUser($user);
    $entityManager->persist($post);
    $entityManager->flush();
    echo "Post criado com sucesso!\n";
}

//Verifica se tem os dados necessários
if ($argc < 4){
    throw new InvalidArgumentException("Você deve informar o ID do usuário, um Título para o Post e o Conteúdo do Post");
}

//Pega os argumentos para passar para a função
$userId = $argv[1];
$title = $argv[2];
$content = $argv[3];

addPost($userId, $title, $content);