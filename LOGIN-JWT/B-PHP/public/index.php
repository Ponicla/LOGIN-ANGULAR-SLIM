<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';


$app = new \Slim\App;


header('Access-Control-Allow-Origin', '*');
header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');

// Ruta clientes
require '../src/rutas/toketizacion.php';
require '../src/rutas/token.php';
require '../src/rutas/login.php' ; 
require '../src/rutas/productos.php';






$app->run();