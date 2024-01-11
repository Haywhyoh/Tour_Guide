<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once 'vendor/autoload.php';

$paths = [ 'models/']; // Path to your entity classes
$isDevMode = true;

// Database configuration parameters
$dbParams = [
    'driver' => 'pdo_mysql',
    'host' => '127.0.0.1',
    'user' => 'tour_admin',
    'password' => 'Mydreams@98',
    'dbname' => 'tour_guide',
];

$config =  ORMSetup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);