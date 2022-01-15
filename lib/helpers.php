<?php
    session_start();
    
    function redirect($url){
        echo "<script type='text/javascript'>"
            ."window.location.href='$url'"
            ."</script>";
    }

    function dd($var){
        echo "<pre>";
        die(print_r($var));
        echo "</pre>";
    }

    //Funcion para crear url, recibe modulo, controlador y funcion como datos primordiales y generar una url.
    function getUrl($modulo, $controlador, $funcion, $parametro=null, $pagina=false){
        //Variable pagina para indicar el archivo index o ajax para enviar peticiones por ajax, por defecto es index.
        if ($pagina == false) {
            $pagina="index";
        }
        //Crea la url
        $url="$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";
        //Verifica si se enviaron parametros en el array $parametro, si se enviaron añade cada valor a la url.
        if ($parametro != null) {
            foreach ($parametro as $key => $valor) {
                $url.="&$key=$valor";
            }
        }
        //Retorna url creada.
        return $url;
    }

    function resolve(){

        // modulo:Carpetas que estan dentro del controlador
        // controlador: un archivo controller que esta dentro del modulo
        // funcion: es un metodo o funcion que está dentro del archivo controlador

        @$modulo=ucwords($_GET['modulo']);
        @$controlador=ucwords($_GET['controlador']);
        @$funcion=$_GET['funcion'];

        //Verifica si existe el modulo
        if (is_dir("../controller/$modulo")) {
            //Verifica si existe el controlador
            if (file_exists("../controller/$modulo/".$controlador."Controller.php")) {
                
                //Incluye el controlador
                include_once "../controller/$modulo/".$controlador."Controller.php";

                //Crea nombre de la clase
                $nombreClase=$controlador."Controller";
                //Crear el objeto
                $objeto=new $nombreClase();
                //Si existe la funcion la llama.
                if (method_exists($objeto,$funcion)) {
                    $objeto->$funcion();
                }else{
                    echo "La funcion o metodo especificado no existe";
                }

            }else{
                echo "El controlador especificado no existe";
            }

        }else{
            echo "El modulo especificado no existe";
        }

    }

?>