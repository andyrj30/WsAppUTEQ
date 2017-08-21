<?php

namespace App\Controllers;

use App\Model\Slider;

class SliderController extends Controller {

    public function index() {
        $sql = 'SELECT * FROM slider where prioridad>0;';
        return Slider::findBySql(1, $sql, $prepare_values);
    }

    public function estado($estado) {
        $field_value['estado'] = $estado;
        return Slider::findWhere('1', $field_value);
    }

}
