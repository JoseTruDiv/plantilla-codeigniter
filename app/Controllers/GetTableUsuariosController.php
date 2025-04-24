<?php

namespace App\Controllers;
use App\Models\UsuariosModel;

class GetTableUsuariosController extends BaseController
{
    public function index()
    {
        $usuariosModels = new UsuariosModel();

        $query = $usuariosModels->findById(1);

        $this->response->setContentType('application/json');

        return json_encode($query);
    }
}
