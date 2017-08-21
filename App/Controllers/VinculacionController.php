<?php

namespace App\Controllers;

use App\Library\Response;

class VinculacionController extends Controller {

    public function estudiantes() {
        $i = 1;
        $array = array();
        $html = file_get_html('http://www.uteq.edu.ec/page/22');

// Find all images 
        foreach ($html->find('section') as $element) {
            $array[$i] = $element->innertext . '<br>';
            break;
        }
        $titulo = "";
        $result = $array[1];
        return Response::view('view', compact('result', 'titulo'));
    }
    public function convenios() {
        $i = 1;
        $array = array();
        $html = file_get_html('http://www.uteq.edu.ec/page/23');

// Find all images 
        foreach ($html->find('section') as $element) {
            $array[$i] = $element->innertext . '<br>';
            break;
        }
        $titulo = "";
        $result = $array[1];
        return Response::view('view', compact('result', 'titulo'));
    }

}
