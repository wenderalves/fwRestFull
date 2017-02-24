<?php
include_once('config.php');
include_once('core/http.php');

use http as ROTA;

//rota
ROTA::post('/incluir-cliente');
ROTA::put('/cliente');
ROTA::get('/listar-cliente');
ROTA::del('/apagar-cliente');

ROTA::start();