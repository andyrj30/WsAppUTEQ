<?php

namespace App\Controllers;

use App\Model\Noticia;

class NoticiaController extends Controller {

    public function index() {
        $query = 'SELECT Uni.titulo as unidad,Cat.descripcion as categoria, Cont.id, Cont.categoria_id ,Cont.titulo,Cont.intro,Cont.texto,Cont.url,Cont.publicacion,Cont.estado FROM contenido Cont,unidad Uni, categoria Cat WHERE Cont.categoria_id=Cat.id and Cont.unidad_id=Uni.id order by Cont.publicacion desc';
        return Noticia::findBySql(1, $query);
    }    

    public function limite($limite) {
        $query = 'SELECT Uni.titulo as unidad,Cat.descripcion as categoria, Cont.id, Cont.categoria_id ,Cont.titulo,Cont.intro,Cont.texto,Cont.url,Cont.publicacion,Cont.estado FROM contenido Cont,unidad Uni, categoria Cat WHERE Cont.categoria_id=Cat.id and Cont.unidad_id=Uni.id order by Cont.publicacion desc LIMIT '.$limite;
        return Noticia::findBySql(1, $query);
    }

    public function id($id) {
        $query = 'SELECT Uni.titulo as unidad,Cat.descripcion as categoria, Cont.id, Cont.categoria_id ,Cont.titulo,Cont.intro,Cont.texto,Cont.url,Cont.publicacion,Cont.estado FROM contenido Cont,unidad Uni, categoria Cat WHERE Cont.categoria_id=Cat.id and Cont.unidad_id=Uni.id and Cont.id='.$id.' order by Cont.publicacion desc';
        return Noticia::findBySql(1, $query);
    }

    public function investigacion() {
         $query = 'SELECT Uni.id as unidad_id, Uni.titulo as unidad,Cat.descripcion as categoria, Cont.id, Cont.categoria_id ,Cont.titulo,Cont.intro,Cont.texto,Cont.url,Cont.publicacion,Cont.estado FROM contenido Cont,unidad Uni, categoria Cat '
                 . 'WHERE Cont.categoria_id=Cat.id and Cont.unidad_id=Uni.id and Cont.unidad_id=12 '
                 . 'order by Cont.publicacion desc';
        return Noticia::findBySql(1, $query);
    }

    public function vinculacion() {
         $query = 'SELECT Uni.id as unidad_id, Uni.titulo as unidad,Cat.descripcion as categoria, Cont.id, Cont.categoria_id ,Cont.titulo,Cont.intro,Cont.texto,Cont.url,Cont.publicacion,Cont.estado FROM contenido Cont,unidad Uni, categoria Cat '
                 . 'WHERE Cont.categoria_id=Cat.id and Cont.unidad_id=Uni.id and Cont.unidad_id=9 '
                 . 'order by Cont.publicacion desc';
        return Noticia::findBySql(1, $query);
    }


    public function unidad($id=1, $limite = 0) {
        $query = 'SELECT Uni.titulo as unidad,Cat.descripcion as categoria, Cont.id, Cont.categoria_id ,Cont.titulo,Cont.intro,Cont.texto,Cont.url,Cont.publicacion,Cont.estado FROM contenido Cont,unidad Uni, categoria Cat WHERE Cont.categoria_id=Cat.id and Cont.unidad_id=Uni.id and Uni.id='.$id.' order by Cont.publicacion desc';
	if($limite != 0){
		$query = $query . ' LIMIT '.$limite;
	}
        return Noticia::findBySql(1, $query);
    }

}
