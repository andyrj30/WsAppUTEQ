<?php

namespace App\Controllers;

use App\Model\Rc;

class RcController extends Controller {

    public function index() {
        return Rc::all(2);
    }

    public function id($id) {
        return Rc::findById(2, $id);
    }

    public function fecha($ano, $mes = 0) {
        $field_value['ano'] = $ano;
        if ($mes != 0) {
            $field_value['mes'] = $mes;
        }
        $options['order_by'] = 'mes';
        return Rc::findWhere(2, $field_value, $options);
    }

    public function anos() {
        $sql = "SELECT DISTINCT ano FROM rc;";
        return Rc::findBySql(2, $sql);
    }

    public function fases($ano = NULL) {
        $sql = "SELECT DISTINCT fase FROM rc ";
        if ($ano != NULL) {
            $sql = $sql . ' Where ano=\'' . $ano . '\'';
        } 
        $sql = $sql . ' ORDER BY fase';
        return Rc::findBySql(2, $sql);
    }

}
