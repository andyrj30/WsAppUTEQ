<?php

namespace App\Controllers;

use App\Library\Response;
use App\Model\Universidad;
use App\Model\Unidad;

class UniversidadController extends Controller {

    public function index() {
        return Universidad::all('1');
    }

    public function historia() {
        $titulo = Universidad::findById('1', 1)[0]['titulo'];
        $subject = Universidad::findById('1', 1)[0]['contenido'];
        $search = 'src="/images';
        $replace = 'src="http://www.uteq.edu.ec/images';
        $result = str_replace($search, $replace, $subject);
        return Response::view('view', compact('result', 'titulo'));
    }

    public function acercade() {
        $subject = Unidad::findById('1', 1)[0];
        $titulo = $subject['titulo'];
        $result = '<center><figure class="post-image"><img src="http://www.uteq.edu.ec/' . $subject['url'] . '" alt=""><p></p></figure></center>
                    <h4 style="border-bottom: 2px solid #084e5e;">Visión</h4>
                    <p>' . $subject['vision'] . ' </p>
                    <p></p>
                    <h4 style="border-bottom: 2px solid #084e5e;">Misión</h4>
                    <p>' . $subject['mision'] . '</p>
                    <p></p>
                    <div class="divider2"></div>
                    <div class="one_half first">
                        <address>
                            ' . $subject['titulo'] . '<br>
                            ' . $subject['direccion'] . '<br>
                            Quevedo - Los Ríos - Ecuador<br>
                        </address>
                    </div>
                    <div class="one_half">
                        <ul class="list none">
                            <li><b>Tel: </b>' . $subject['telefono'] . '</li> 
                            <li><b>Email: </b><a href="mailto:info@uteq.edu.ec">' . $subject['correo'] . '</a>.</li>
                        </ul>
                    </div';
        return Response::view('view', compact('result', 'titulo'));
    }

    public function autoridades() {
        $titulo = Universidad::findById('1', 2)[0]['titulo'];
        $subject = Universidad::findById('1', 2)[0]['contenido'];
        $search = 'src="/images';
        $replace = 'src="http://www.uteq.edu.ec/images';
        $result = str_replace($search, $replace, $subject);
        return Response::view('view', compact('result', 'titulo'));
    }

    public function consejo() {
        $titulo = Universidad::findById('1', 3)[0]['titulo'];
        $subject = Universidad::findById('1', 3)[0]['contenido'];
        $search = 'src="/images';
        $replace = 'src="http://www.uteq.edu.ec/images';
        $result = str_replace($search, $replace, $subject);
        return Response::view('view', compact('result', 'titulo'));
    }

    public function identidad() {
        $titulo = Universidad::findById('1', 4)[0]['titulo'];
        $subject = Universidad::findById('1', 4)[0]['contenido'];
        $search = '"/images';
        $replace = '"http://www.uteq.edu.ec/images';
        $result = str_replace($search, $replace, $subject);
        return Response::view('view', compact('result', 'titulo'));
    }

}
