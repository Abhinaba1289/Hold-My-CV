<?php

class Database{
private $host= '127.0.0.1';
private $username = 'root';

private $database = 'resume';
private $password= '';

private $db=null;

function __construct(){
   $this->db=new mysqli($this->host,$this->username,$this->password,$this->database);
}

public function connect(){
    return $this->db;
}

}

$db=new Database();
$db=$db->connect();