<?php

namespace App\Controllers;
use App\Models\UsuariosModel;

class GetTableUsuariosController extends BaseController
{
    public function index()
    {
        $usuariosModels = new UsuariosModel();

        $query = $usuariosModels->findById(1);

        var_dump($query);
    }
}
