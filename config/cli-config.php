<?php
declare(strict_types=1);
require_once dirname(__DIR__, 1) . '/vendor/autoload.php';
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Console\Helper\HelperSet;

$paths = [dirname(__DIR__, 1) . '/src/Model/Entities'];
$isDevMode = true;
$dbParams = require 'migrations-db.php';
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
try {
    $entityManager = EntityManager::create($dbParams, $config);
} catch (ORMException $e) {
    print $e->getMessage() . PHP_EOL;
    print $e->getTraceAsString();
    exit(1);
}
return new HelperSet(
    [
        'em' => new EntityManagerHelper($entityManager),
        'db' => new ConnectionHelper($entityManager->getConnection()),
    ]
);
