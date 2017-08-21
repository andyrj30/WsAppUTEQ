<?php

namespace App\Controllers;

use App\Model\Lotaip;

class LotaipController extends Controller {

    public function index() {
        return Lotaip::all(2);
    }

    public function id($id) {
        return Lotaip::findById(2, $id);
    }

    public function fecha($ano, $mes = 0) {
        $field_value['ano'] = $ano;
        if ($mes != 0) {
            $field_value['mes'] = $mes;
        }
        $options['order_by'] = 'mes';
        return Lotaip::findWhere(2, $field_value, $options);
    }

    public function anos() {
        $sql = "SELECT DISTINCT ano FROM lotaip;";
        return Lotaip::findBySql(2, $sql);
    }

    public function meses($ano) {
        $sql = "SELECT DISTINCT mes FROM lotaip ";
        if ($ano != NULL) {
            $sql = $sql . ' Where ano=\'' . $ano . '\'';
        }
        return Lotaip::findBySql(2, $sql);
    }

    public function mesesxano() {
        $sql = "SELECT DISTINCT mes FROM lotaip;";
        return Lotaip::findBySql(2, $sql);
    }

}
