<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . '/../vendor/autoload.php';

$paths = [__DIR__ . 'models/user.php']; // Path to your entity classes
$isDevMode = true;

// Database configuration parameters
$dbParams = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'user' => 'tour_admin',
    'password' => 'Mydreams@98',
    'dbname' => 'tour_guide',
];

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);
