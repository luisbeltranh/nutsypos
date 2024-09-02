<?php

namespace App\Controllers;

use App\Models\ProductosModel;


class Home extends BaseController
{
    public function index()
    {
        $modelo = new ProductosModel();
        $productos = $modelo->findAll();

        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['productos'] = $productos;
        echo view('dashboard/pos2', $datos);
    }
}
