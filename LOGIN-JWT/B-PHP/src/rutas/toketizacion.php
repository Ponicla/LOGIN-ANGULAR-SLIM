<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Firebase\JWT\JWT;

    function valida_token($jwt){
        try{
            $key = "abc123";
            $data = JWT::decode($jwt, $key, array('HS256'));
            return $data;
        }catch(Exception $e){
            return false;
        }
    }
