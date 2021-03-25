<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Firebase\JWT\JWT;


// GET Todos los clientes 
$app->post('/api/login', function(Request $request, Response $response){
  $USR = $request->getParam('usr');
  $PAS = $request->getParam('pas');
  $sql = "SELECT * FROM USUARIO WHERE USR = :USR AND PAS = :PAS";
  

  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);

    $resultado->bindParam(':USR', $USR);
    $resultado->bindParam(':PAS', $PAS);
    $resultado->execute();

    $res = $resultado->fetchAll(PDO::FETCH_OBJ);

    if($res){
      $key = "abc123";
      $time = time();
      $token = [
        'iat' => $time, 
        'exp' => $time + 50000,
        'data' => [
          'user' => 'juan', 
          'nombre' => 'juan'
        ]
      ];
      $jwt = JWT::encode($token, $key);
  
      $obj = (object) array('token' => $jwt);
      echo json_encode($obj);
    }else{
      return null;
    }  
  }catch(PDOException $e){
    echo '{"error" : {"text":'.$e->getMessage().'}';
  }

}); 











