<?php

class db{
    private $dbHost = 'localhost\SQLEXPRESS';
    private $dbUser = 'TU_NOMBRE_USUARIO';
    private $dbPass = 'TU_CONTRASEÑA';
    private $dbName = 'NOMBRE_BASE_DE_DATOS';

    //conexion
    public function conectDB(){
      $dbConnection = new PDO("sqlsrv:Server=localhost\SQLEXPRESS,PUERTO SQL SERVER 1433 DEFECTP;Database=NOMBRE_BASE_DE_DATOS", "TU_NOMBRE_USUARIO", "TU_CONTRASEÑA");
      $dbConnection -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
      return $dbConnection;
    }
  }
