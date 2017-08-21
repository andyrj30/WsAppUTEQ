<?php

namespace App\Controllers;

use App\Model\Unidad;

class UnidadController extends Controller {

    public function index() {
        return Unidad::all(1);
    }

    public function id($id) {
        return Unidad::findById(1, $id);
    }

}
