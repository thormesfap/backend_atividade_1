<?php

namespace App\Entities;

use App\Entities\Trait\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[ORM\HasLifecycleCallbacks]
class User
{

    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: Types::STRING)]
    private string $name;


    #[ORM\Column(type: Types::STRING, unique: true)]
    private string $email;

    //Configuração de relação entre posts e usuário. Opção cascade permite que o ORM, ao apagar usuários, automaticamente já apague todos os posts vinculados ao usuário
    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'user', cascade: ['persist' , 'remove'], orphanRemoval: true)]
    private Collection $posts;

    public function __construct(){
        $this->posts = new ArrayCollection();
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email Inválido");
        }
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function addPost(Post $post): void
    {
        $this->posts->add($post);
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }
    
    public function removePost(Post $post): void
    {
        $this->posts->removeElement($post);
    }

    /**
     * Função que imprime no console o nome do usuário e o título dos posts
     * @return void
     */
    public function printPostagens(): void
    {
        echo "Usuário: " . $this->getName() . PHP_EOL;
        echo "Postagens:" . PHP_EOL;
        if($this->posts->count() == 0){
            echo "\t- Nenhuma Postagem" . PHP_EOL . PHP_EOL;
            return;
        }

        foreach($this->posts as $post){
            echo "\t- " . $post->getTitle() . PHP_EOL;
        }
        echo PHP_EOL;
    }
}