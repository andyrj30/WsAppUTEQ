<?php

namespace App\Controllers;

use App\Model\SubMenu;

class SubmenuController extends Controller {

    public function index() {
        return SubMenu::all('1');
    }

    public function tipo($tipo) {
        $field_value['munu_id'] = $tipo;
        return SubMenu::findWhere('1', $field_value);
    }   
   
}
