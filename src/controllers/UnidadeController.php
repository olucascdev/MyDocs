<?php

class UnidadeController extends RenderView
{
  public function index()
  {
    $unidades = new UnidadesModel();
    $unidadeData = $unidades->fetch();

    $this->loadView('TelaUnidades', [
      'unidades' => $unidadeData
    ]);
  }
}