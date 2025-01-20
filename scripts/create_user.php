<?php

require_once __DIR__ . '/../bootstrap.php';




function addUser(string $name, string $email): void
{
    global $entityManager;
    $existing = $entityManager->getRepository(\App\Entity\User::class)->findOneBy(['email' => $email]);
    if($existing){
        echo "Usuário já está cadastrado\n";
        return;
    }
    $user = new \App\Entity\User();
    $user->setName($name);
    $user->setEmail($email);
    $entityManager->persist($user);
    $entityManager->flush();
    echo "Usuario criado com sucesso!\n";
}

$newUserName = $argv[1];
$newEmail = $argv[2];
addUser($newUserName, $newEmail);
