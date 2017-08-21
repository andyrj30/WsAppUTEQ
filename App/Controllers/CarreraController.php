<?php

namespace App\Controllers;

use App\Model\Carrera;

class CarreraController extends Controller {

    public function index() {
        return Carrera::all('1');
    }

    public function id($id) {
        return Carrera::findById(1, $id);
    }

    public function unidad($id=1) {
        $field_value['unidad_id'] = $id;
        return Carrera::findWhere('1', $field_value);
    }
}
