<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Firebase\JWT\JWT;



$app->get('/api/verifica_token', function(Request $request, Response $response){
    $key = 'abc123';
    $header_auth =  $request->getHeader('Authorization');
    $token = $header_auth[0];
    $res = '';
    if(valida_token($token) == false){
        return json_encode(false);
        // return $response(['messaje' => 'Token invalido'], 401);
    }else{
        $data = JWT::decode($token, $key, array('HS256'));
        return json_encode(true);
        // return $response(['data' => $data], 200);
    }
}); 

$app->post('/api/verifica_token2', function(Request $request, Response $response){
    $key = 'abc123';
    
    $token = $request->getParam('token'); 
    $res = '';
    if(valida_token($token) == false){
        return json_encode(false);
        // return $response(['messaje' => 'Token invalido'], 401);
    }else{
        $data = JWT::decode($token, $key, array('HS256'));
        return json_encode(true);
        // return $response(['data' => $data], 200);
    }
});