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

    public static function post( $url , $controller ){
        array_push( self::$http, ["url" => $url, "metodo" => "POST", "cont-func" => $controller]);
    }

    public static function put( $url , $controller ){
        array_push( self::$http, ["url" => $url, "metodo" => "PUT", "cont-func" => $controller]);
    }

    public static function get( $url , $controller ){
        array_push( self::$http, ["url" => $url, "metodo" => "GET", "cont-func" => $controller]);
    }
   
    public static function del( $url , $controller ){
        array_push( self::$http, ["url" => $url, "metodo" => "DELETE", "cont-func" => $controller]);
    }

    protected static function atributeToController( $controller ){ // controller/atribute/$1/$2/$3
        $class = "./controller/".$controller;
                
        if (file_exists($class.".php")) {
            include_once($class.".php");
        }else{ 
            return false;
        }        

        if( class_exists("teste") ){
            return "classe teste Existe";
        } else {
            return "classe teste Não Existe";
        }
    }

    protected static function processa($url, $contFunc){
        echo $url." - ".$contFunc;
    }

    public static function start(){
        $metodo = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['QUERY_STRING'];   
        //var_dump( self::$http );

        /*
         * Verificar se a url solicitada está no array
         * verificar se o controller existe
         * retornar o que foi solicitado
         */        
        foreach(self::$http as $URLS){
            $RotaDados = [];
            foreach($URLS as $ky => $vl){                
                if($ky === 'url'){
                    if($url == $vl){
                      $RotaDados['url'] = $vl;
                    }                    
                }
                if($ky === 'cont-func'){
                    $RotaDados['cont-func'] = $vl;
                }
                if($ky === 'metodo'){
                    if($metodo == $vl){
                      $RotaDados['metodo'] = $vl;
                    }                    
                }
            }            
            if (count($RotaDados) <= 3 && count($RotaDados) > 2){
                self::processa($RotaDados['url'], $RotaDados['cont-func']);
                break;
            }            
        }
    }

}