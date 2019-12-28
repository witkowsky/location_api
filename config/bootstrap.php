<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use App\Repository\LocationRepositoryInterface;
use App\Repository\LocationRepository;
use App\Entity\Location;

require_once dirname(__DIR__) . "/vendor/autoload.php";

/*
 * Doctrine
 */
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(
    array(dirname(__DIR__) . "/src/Entity"),
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => dirname(__DIR__) . '/db.sqlite',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
$classMetaData = $entityManager->getClassMetadata(Location::class);

/*
 * Dependency Injection
 */
$containerBuilder = new ContainerBuilder();

/* register repository */
$containerBuilder
    ->register(LocationRepositoryInterface::class, LocationRepository::class)
    ->addArgument($entityManager)
    ->addArgument($classMetaData);
/* register other services */
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('services.yaml');
$containerBuilder->compile();
