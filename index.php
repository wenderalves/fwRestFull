<?php
include_once('config.php');
include_once('core/http.php');

use http as ROTA;

//rota
ROTA::get('', 'index@index');
ROTA::get('i', 'teste@inicio'); //controller@atributo

ROTA::start();