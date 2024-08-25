<?php
require_once "DataBase.php";
$dataBase = new DataBase();

class User
{
  protected $id;
  protected $username;
  protected $pass;

  function __construct($data)
  {
    $this->id = $data["id"] ?? 'none';
    $this->username = $data["username"] ?? 'none';
    $this->pass = $data["pass"] ?? 'none';
  }

  function checkUsername()
  {
    global $dataBase;

    $data = $dataBase->getUserName($this->username);

    return $data;
  }

  function registUser()
  {
    global $dataBase;

    $dataBase->addUser($this->username, $this->pass);
  }

  function checkUsernameAndPass()
  {
    global $dataBase;

    $data = $dataBase->getUserNamePass($this->username, $this->pass);

    return $data;
  }

  function isAdmin()
  {
    global $dataBase;

    $user = $dataBase->getUserId($this->id);

    return $user["admin"];
  }
}
