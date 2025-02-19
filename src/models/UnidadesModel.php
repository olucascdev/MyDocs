<?php

class UnidadesModel
{
  public function fetch()
  {
    $db = Database::getConnection();
    $stmt = $db->query('SELECT * FROM estabelecimentos');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}