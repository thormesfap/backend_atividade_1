<?php


require_once __DIR__ . '/../../bootstrap.php';


function getUsersWithPosts($userId = null)
{
    global $entityManager;
    //Se for informado um id de usuário como parâmetro do script, busca as mensagens do usuário específico
    if ($userId !== null) {
        /**
         * @var \App\Entities\User|null $user
         */
        $user = $entityManager->getRepository(\App\Entities\User::class)->find($userId);

        //Se usuário informado não for encontrado, informa
        if ($user == null) {
            echo "Usuário não encontrado!\n";
            exit(1);
        }
        $user->printPostagens();
    } else {
        //busca todos os usuários. Como há relacionamento dos usuários com posts na entidade, o ORM busca todas as postagens ao acessar esse atributo
        $users = $entityManager->getRepository(\App\Entities\User::class)->findAll();
        foreach ($users as $user) {
            $user->printPostagens();
        }
    }
}

$userId = $argv[1] ?? null;
getusersWithPosts($userId);
