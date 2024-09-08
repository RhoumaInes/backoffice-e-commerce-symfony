<?php 
// config/bootstrap.php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManagerInterface;

// Configuration des paramètres de connexion à la base de données
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'courseexpress',
);

// Configuration de Doctrine
$config = Setup::createAnnotationMetadataConfiguration(
    [__DIR__ . '/../src/Entity'], // Chemin vers les entités
    true, // Dev mode
    null, // Proxy dir
    null, // Cache
    false // Use Simple Annotation Reader
);

// Création de l'EntityManager
$entityManager = EntityManager::create($dbParams, $config);

// Retourner l'EntityManager
return $entityManager;