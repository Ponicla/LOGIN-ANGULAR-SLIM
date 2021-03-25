<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


// GET Todos los clientes 
$app->get('/api/productos', function(Request $request, Response $response){
  
  $key = 'abc123';
  $header_auth =  $request->getHeader('Authorization');
  $token = $header_auth[0];
  $res = '';
  $sql = "SELECT * FROM PRODUCTO"; 
  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->query($sql);
    $productos = $resultado->fetchAll(PDO::FETCH_OBJ);

  if ($productos){
    if(valida_token($token) == false){
      $res = [
        'message' => 'Token invalido'
      ];
      return json_encode($res);
    }else{
      /* $data = JWT::decode($token, $key, array('HS256'));
      $res = [
        'data' => $data
      ];
      return json_encode($res); */
      return json_encode($productos);
    }
  }else {
    echo json_encode("No existen productos");
  }
  $resultado = null;
  $db = null;
  }catch(PDOException $e){
    echo '{"error" : {"text":'.$e->getMessage().'}';
  }
}); 


// GET Recueperar cliente por ID 
$app->get('/api/productos/{ID}', function(Request $request, Response $response){
  $ID_PRODUCTO = $request->getAttribute('ID');
  $sql = "SELECT * FROM PRODUCTO WHERE ID_PRODUCTO = $ID_PRODUCTO";
  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->query($sql);
    $producto = $resultado->fetchAll(PDO::FETCH_OBJ);
    if ($producto){
      echo json_encode($producto);
    }else {
      echo json_encode("No existe producto con este ID");
    }
    $resultado = null;
    $db = null;
  }catch(PDOException $e){
    echo '{"error" : {"text":'.$e->getMessage().'}';
  }
}); 


// POST Crear nuevo cliente 
$app->post('/api/productos/agregar', function(Request $request, Response $response){
   $PRODUCTO = $request->getParam('PRODUCTO');
   $DESCRIPCION = $request->getParam('DESCRIPCION'); 
  
  $sql = "INSERT INTO PRODUCTO (PRODUCTO, DESCRIPCION) VALUES 
          (:PRODUCTO, :DESCRIPCION)";
  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);

    $resultado->bindParam(':PRODUCTO', $PRODUCTO);
    $resultado->bindParam(':DESCRIPCION', $DESCRIPCION);
    $resultado->execute();
    echo json_encode("Nuevo producto generado");  

    $resultado = null;
    $db = null;
  }catch(PDOException $e){
    echo '{"error" : {"text":'.$e->getMessage().'}';
  }
}); 


// PUT Modificar cliente 
$app->put('/api/productos/modificar/{ID}', function(Request $request, Response $response){
   $ID_PRODUCTO = $request->getAttribute('ID');
   $PRODUCTO = $request->getParam('PRODUCTO');
   $DESCRIPCION = $request->getParam('DESCRIPCION');
  
  $sql = "UPDATE PRODUCTO SET
          PRODUCTO = :PRODUCTO,
          DESCRIPCION = :DESCRIPCION
          WHERE ID_PRODUCTO = $ID_PRODUCTO";
     
  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);

    $resultado->bindParam(':PRODUCTO', $PRODUCTO);
    $resultado->bindParam(':DESCRIPCION', $DESCRIPCION);

    $resultado->execute();
    echo json_encode("Producto modificado");  

    $resultado = null;
    $db = null;
  }catch(PDOException $e){
    echo '{"error" : {"text":'.$e->getMessage().'}';
  }
}); 


// DELETE borar cliente 
$app->delete('/api/productos/eliminar/{ID}', function(Request $request, Response $response){
   $ID_PRODUCTO = $request->getAttribute('ID');
   $sql = "DELETE FROM PRODUCTO WHERE ID_PRODUCTO = $ID_PRODUCTO";
     
  try{
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);
     $resultado->execute();

    if ($resultado->rowCount() > 0) {
      echo json_encode("Producto eliminado");  
    }else {
      echo json_encode("No existe producto con este ID");
    }

    $resultado = null;
    $db = null;
  }catch(PDOException $e){
    echo '{"error" : {"text":'.$e->getMessage().'}';
  }
}); 







