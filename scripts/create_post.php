<?php

require_once __DIR__ . '/../bootstrap.php';
function addPost($userId, $title, $content): void
{
    global $entityManager;
    $user = $entityManager->getRepository(\App\Entity\User::class)->find($userId);
    if (!$user) {
        echo "Usuário não encontrado.\n";
        exit(1);
    }

    $post = new \App\Entity\Post();
    $post->setTitle($title);
    $post->setContent($content);
    $post->setUser($user);
    $entityManager->persist($post);
    $entityManager->flush();
    echo "Post criado com sucesso!\n";
}

$userId = $argv[1];
$title = $argv[2];
$content = $argv[3];
addPost($userId, $title, $content);