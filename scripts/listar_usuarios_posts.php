<?php


require_once __DIR__ . '/../bootstrap.php';


function getUsersWithPosts($userId = null)
{
    global $entityManager;
    if ($userId !== null) {
        /**
         * @var \App\Entity\User|null $user
         */
        $user = $entityManager->getRepository(\App\Entity\User::class)->find($userId);
        if ($user == null) {
            echo "Usuário não encontrado!\n";
            exit(1);
        }
        $user->printPostagens();
    } else {
        $dql = "SELECT u FROM App\Entity\User u";
        $query = $entityManager->createQuery($dql);
        $users = $query->getResult();
        foreach ($users as $user) {
            $user->printPostagens();
        }
    }
}

$userId = $argv[1] ?? null;
getusersWithPosts($userId);
