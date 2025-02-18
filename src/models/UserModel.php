<?php

class UserModel extends Database
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = $this->getConnection();
  }

  public function fetch()
  {
    $stm = $this->pdo->query("SELECT * FROM usuarios");
    if ($stm->rowCount() > 0) {
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    } else {
      return [];
    }
  }
}