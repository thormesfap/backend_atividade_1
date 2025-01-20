<?php

// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

// Cria configuração do ORM para trabalhar com atributos do PHP
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src'],
    isDevMode: true,
);

// Configura a conexão
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'password' => 'root',
    'user' => 'root',
    'host' => 'localhost',
    'port' => '3306',
    'charset' => 'utf8',
    'dbname' => 'backend_atividade_1',
], $config);

// Obter Entity Manager
$entityManager = new EntityManager($connection, $config);