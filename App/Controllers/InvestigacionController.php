<?php

namespace App\Controllers;

use App\Library\Response;
use App\Model\Universidad;

class InvestigacionController extends Controller {

    public function investigadores() {
        $titulo = Universidad::findById('1', 5)[0]['titulo'];
        $subject = Universidad::findById('1', 5)[0]['contenido'];
        $search = 'src="/images';
        $replace = 'src="http://www.uteq.edu.ec/images';
        $result = str_replace($search, $replace, $subject);
        return Response::view('view', compact('result', 'titulo'));
    }

    public function lineas() {
        $titulo = Universidad::findById('1', 6)[0]['titulo'];
        $subject = Universidad::findById('1', 6)[0]['contenido'];
        $search = 'src="/images';
        $replace = 'src="http://www.uteq.edu.ec/images';
        $result = str_replace($search, $replace, $subject);
        return Response::view('view', compact('result', 'titulo'));
    }

    public function proyectos() {
        $titulo = Universidad::findById('1', 7)[0]['titulo'];
        $subject = Universidad::findById('1', 7)[0]['contenido'];
        $search = 'src="/images';
        $replace = 'src="http://www.uteq.edu.ec/images';
        $result = str_replace($search, $replace, $subject);
        return Response::view('view', compact('result', 'titulo'));
    }

}
