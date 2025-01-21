<?php

// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

date_default_timezone_set('America/Sao_Paulo');

// Cria configuração do ORM para trabalhar com atributos do PHP
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src/Entities'],
    isDevMode: true,
);

// Configura a conexão
$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/database.sqlite',
], $config);

// Obter Entity Manager
$entityManager = new EntityManager($connection, $config);