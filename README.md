## Passos iniciais
Dentro da pasta da aplicação, execute o comando
```
composer install
```

Após download e instalação das dependências, execute o comando abaixo para criação do banco de dados. A configuração padrão é para um banco de dados sqlite. Para alterar a configuração do banco de dados, edite a conexão com o banco de dados no arquivo `bootstrap.php`

```
php bin/doctrine orm:schema-tool:create
```

---

Após criação das tabelas do banco de dados, os comandos abaixos podem ser executados:

### Criação de Usuário
Obrigatório informar nome do usuário e email. Para usar nome completo, envolver o nome em aspas
```
php src/Scripts/create_user.php 'Nome de Usuário' 'email@exemplo.com'
```

### Criação de Post
Obrigatório informar o id do usuário, Título do Post e Conteúdo do Post.
```
php src/Scripts/create_post.php idUsuario 'Título do Post' 'Conteúdo do Post'
```

### Listar Usuários e Respectivos Posts
Opcional informar id do usuário. Caso informado, traz somente os do usuário informado. Se não informado, traz de todos os usuários
```
php src/Scripts/listar_usuarios_posts.php [idUsuario]
```

### Apagar Usuário
Obrigatório informar o id do usuário. Apaga o usuário e os posts relacionados.
```
php src/Scripts/delete_user.php idUsuario
```