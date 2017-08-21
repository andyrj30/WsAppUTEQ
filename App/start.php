<?php

require 'core/database.php';
require 'core/firebase.php';

$DIR_ROOT = dirname(__DIR__);
$ws = '';
$tipo = '';
if (isset($_GET['ws'])) {
    $ws = ucfirst(filter_var(rtrim($_GET['ws'], '/')));
}
if (file_exists('app/controllers/' . $ws . '.php')) {
    require_once 'app/controllers/' . $ws . '.php';
}
if ($ws == 'Institucion') {
    $obj = new Institucion();
    echo $obj->index();
}
if ($ws == 'Noticia') {
    $obj = new Noticia();
    echo $obj->index();
}
if ($ws == 'Lotaip') {
    $obj = new Lotaip();
    echo $obj->index();
}
