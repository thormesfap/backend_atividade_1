<?php
require_once __DIR__ . '/../bootstrap.php';
function deleteUser($userId){
    global $entityManager;
    $user = $entityManager->getRepository(\App\Entity\User::class)->find($userId);
    if ($user == null) {
        echo "Usuário não encontrado!\n";
        exit(1);
    }
    $entityManager->remove($user);
    $entityManager->flush();
    echo "Usuário deletado com sucesso!\n";
}

$userId = $argv[1];
deleteUser($userId);