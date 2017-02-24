<?php 
/**
 * Helper de HTTP
 *
 * @author Wender Alves Sobrinho <wender_net@hotmail.com>
 * @version 0.0.1
 * @date 23/02/2017
 * @date updated 23/02/2017
 */

class http{

    public static $http = array();
    
    private function verificaURL(){
        $metodo = $_SERVER['REQUEST_METHOD'];
        $conteudo = file_get_contents('php://input');

        switch ($metodo ) {
        case 'PUT':
            return $conteudo; 
            break;
        case 'POST':
            return $conteudo;
            break;
        case 'GET':
            return $conteudo;
            break;        
        case 'DELETE':
            return $conteudo;
            break;        
        default:
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
            die('{"msg": "Método não encontrado."}');  
            break;
        }
    }

    public static function post( $url ){
        array_push( self::$http, ["url" => $url, "metodo" => "POST"]);
    }

    public static function put( $url ){
        array_push( self::$http, ["url" => $url, "metodo" => "PUT"]);
    }

    public static function get( $url ){
        array_push( self::$http, ["url" => $url, "metodo" => "GET"]);
    }
   
    public static function del( $url ){
        array_push( self::$http, ["url" => $url, "metodo" => "DELETE"]);
    }

    public static function start(){
        $metodo = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['QUERY_STRING'];        
        var_dump($url);
    }

}