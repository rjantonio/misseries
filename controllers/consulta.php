<?php

class Consulta extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->series = [];

    }

    function render() {
        $series =  $this->model->get();
        //$series = "Hola";
        $this->view->series = $series;
        $this->view->render('consulta/index');
    }

    function verSerie($param = null){

        $titulo = $param[0];
        $serie = $this->model->getById($titulo);

        $this->view->serie = $serie;
        $this->view->render('consulta/detalle');

    }

    function actualizarSerie($param = null){

        $titulo = $param[0];
        $serie = $this->model->getById($titulo);
        $generos = $this->model->getGeneros();

        $this->view->serie = $serie;
        $this->view->generos = $generos;
        $this->view->mensaje = "";

        $this->view->render('consulta/gestiona');

    }

    function editarSerie($param = null){

        $titulo = $param[0];
        $serie = $this->model->getById($titulo);
        $generos = $this->model->getGeneros();

        $this->view->serie = $serie;
        $this->view->generos = $generos;
        $this->view->mensaje = "";

        $this->view->render('consulta/edita');

    }

    function updateSerie($param = null) {

        $titulo = $param[0];
        $serie = $this->model->getById($titulo);

        $fecha = $_POST['fecha'];
        $temps = $_POST['temps'];
        $punt = $_POST['punt'];
        $argu = $_POST['argu'];

        if($this->model->update(['titulo' => $titulo, 'fecha' => $fecha, 'temporadas' => $temps,'puntuacion' => $punt,'argumento' => $argu])){

            $serie->fecha = $fecha;
            $serie->temporadas = $temps;
            $serie->puntuacion = $punt;
            $serie->argumento = $argu;

            $this->view->serie = $serie;
            $this->view->mensaje = "Serie actualizada correctamente";

        } else {

                $this->view->mensaje = "Error al actualizar la serie";

        }

        $this->view->render('consulta/edita');

    }

    function deleteGenero($param = null) {

        $titulo = $param[0];
        $genero = isset($param[1]) ? $param[1] : "";
        $serie = $this->model->getById($titulo);
        $generos = $this->model->getGeneros();

        if($this->model->delete(['ids' => $serie->id, 'genero' => $genero])) {

            $serie = $this->model->getById($titulo);
            $this->view->serie = $serie;
            $this->view->generos = $generos;
            $this->view->mensaje = "Género borrado correctamente";


        }   else {

                $this->view->mensaje = "Error al borrar el género";

        }

        $this->view->render('consulta/gestiona');

    }

    function addGenero($param = null) {

        $titulo = $param[0];
        $genero = isset($_POST['genero']) ? $_POST['genero'] : "default";
        $serie = $this->model->getById($titulo);
        $generos = $this->model->getGeneros();

        //comprueba que queramos añadir un genero nuevo y que el selector de generos esté vacío
        if (isset($_POST['nuevogen'])&&(($_POST['genero'])=="nada")&&$_POST['nuevogen']!="") {

            //inserta el nuevo genero en la base de datos.

            if ($this->model->newGenero(['ids' => $serie->id, 'genero' => $_POST['nuevogen']])) {

                $serie = $this->model->getById($titulo);
                $this->view->serie = $serie;
                $this->view->generos = $this->model->getGeneros();
                $this->view->mensaje = "Género añadido a la base de datos con éxito";

            } else {

                $serie = $this->model->getById($titulo);
                $this->view->serie = $serie;
                $this->view->generos = $generos;
                $this->view->mensaje = "Error al insertar género en la base de datos";

            }

            $this->view->render('consulta/gestiona');

        } else {

            //entra para imprimir por pantalla el nuevo formulario para generar un nuevo genero
            if ($genero == "nuevo") {

                $serie = $this->model->getById($titulo);
                $this->view->serie = $serie;
                $this->view->generos = $generos;
                $this->view->nuevo = true;
                $this->view->mensaje = "nuevo";
    
                $this->view->render('consulta/gestiona');
    
            } else if ($genero != "nada"){
    
                if($this->model->add(['ids' => $serie->id, 'genero' => $genero])) {
    
                    $serie = $this->model->getById($titulo);
                    $this->view->serie = $serie;
                    $this->view->generos = $generos;
                    $this->view->mensaje = "Género añadido correctamente";
        
                }   else {
        
                        $this->view->serie = $serie;
                        $this->view->mensaje = "Error al añadir el género";
        
                }
        
                $this->view->render('consulta/gestiona');
    
            } else {

                $serie = $this->model->getById($titulo);
                $this->view->serie = $serie;
                $this->view->generos = $generos;
                $this->view->mensaje = "Por favor elija un género antes de pulsar añadir";

                $this->view->render('consulta/gestiona');

            }

        }

        

        

    }
}



?>