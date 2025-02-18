<?php

class UserModel
{
  public function fetch()
  {
    $db = Database::getConnection();
    $stmt = $db->query('SELECT * FROM usuarios');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}