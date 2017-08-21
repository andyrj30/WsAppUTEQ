<?php

namespace App\Controllers;

use App\Model\Archivo;

class ArchivoController extends Controller {

    public function index() {
        $sql = 'SELECT Arc.*,Cat.descripcion as categoria FROM archivo Arc, archivocategoria Cat where Arc.categoria_id=Cat.id';
        return Archivo::findBySql('2', $sql);
    }

    public function menu($id) {
        if ($id != NULL) {
            $sql = 'SELECT Arc.*,Cat.descripcion as categoria FROM archivo Arc, archivocategoria Cat where Arc.categoria_id=Cat.id and Cat.id=\'' . $id . '\'';
        } else {
            $sql = 'SELECT * FROM archivocategoria LIMIT 100;';
        }
        return Archivo::findBySql('2', $sql);
    }
}
