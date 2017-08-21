<?php

namespace App\Controllers;

use App\Model\Menu;

class MenuController extends Controller {

    public function index() {
        return Menu::all('1');
    }
    
    
    public function tipo($tipo) {
        $field_value['menu_tipo_id'] = $tipo;
        return Menu::findWhere('1', $field_value);
    }
}
