<?php

require_once __DIR__ . '/../../bootstrap.php';




function addUser(string $name, string $email): void
{
    global $entityManager;
    //Buscar se usuário já existe com mesmo e-mail para não cadastrar em duplicidade
    $existing = $entityManager->getRepository(\App\Entities\User::class)->findOneBy(['email' => $email]);
    if($existing){
        echo "Usuário já está cadastrado\n";
        return;
    }
    //Cadastra o usuário caso não exista um com o mesmo e-mail
    $user = new \App\Entities\User();
    $user->setName($name);
    $user->setEmail($email);
    $entityManager->persist($user);
    $entityManager->flush();
    echo "Usuário criado com sucesso!\n";
}
//Verifica se tem os dados necessários
if ($argc < 3){
    throw new InvalidArgumentException("Você deve informar um Nome de Usuário e um Email");
}
//Pega os dois primeiros argumentos do script como nome e e-mail
$newUserName = $argv[1];
$newEmail = $argv[2];
addUser($newUserName, $newEmail);
