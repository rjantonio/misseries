<?php

include_once 'models/serie.php';

class ConsultaModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function get() {
        $items = [];

        try{
            
            $query = $this->db->connect()->query("SELECT * FROM serie");

            while($row = $query->fetch()){
                $item = new Serie();
                $item->titulo = $row['titulo'];
                $item->puntuacion = $row['puntuacion'];
                $item->plataforma = $row['plataforma'];

                array_push($items, $item);

            }

            return $items;
            
            


        }catch(PDOException $e){
            return [];
        }

        

    }

    //obtiene una serie por su titulo
    public function getById($id) {
        $item = new Serie();
        $aux = [];

        $query = $this->db->connect()->prepare("SELECT * FROM serie WHERE titulo = :titulo");
        

        try {

            $query->execute(['titulo' => $id]);

            

            while ($row = $query->fetch()){
                $item->titulo = $row['titulo'];
                $item->poster = $row['poster'];
                $item->plataforma = $row['plataforma'];
                $item->argumento = $row['argumento'];
                $item->puntuacion = $row['puntuacion'];
                $item->fecha = $row['fecha'];
                $item->temporadas = $row['temporadas'];
                $item->id = $row['ids'];

                $query2 = $this->db->connect()->query("SELECT DISTINCT genero 
                                                        FROM genero 
                                                        WHERE idg in (SELECT DISTINCT idg 
                                                                    FROM pertenece 
                                                                    WHERE ids = $item->id)");
                
                while ($row = $query2->fetch()){

                    array_push($aux, $row[0]);

                }

                $item->generos = $aux;


            }

            return $item;

        }catch(PDOException $e) {
            return null;

        }
    }

    //obtiene los generos que tiene una serie
    public function getGeneros () {

        $generos = [];

        $query = $this->db->connect()->prepare("SELECT genero FROM genero");

        try {

            $query->execute();

            while ($row = $query->fetch()){

                array_push($generos, $row[0]);

            }

            return $generos;

        }catch(PDOException $e) {
            return null;

        }

    }


    //actualiza una serie con los nuevos valores
    public function update($item) {
        $query = $this->db->connect()->prepare("UPDATE serie SET fecha = :fecha, temporadas = :temporadas, puntuacion = :puntuacion, argumento = :argumento WHERE titulo = :titulo");
        try{
            $query->execute([
                'titulo'=>$item['titulo'],
                'fecha'=>$item['fecha'],
                'temporadas'=>$item['temporadas'],
                'puntuacion'=>$item['puntuacion'],
                'argumento'=>$item['argumento'],
            ]);

            return true;

        }catch(PDOException $e){
            return false;
        }
    }

    //borra la relación entre serie y género
    public function delete($item) {

        $query = $this->db->connect()->prepare("DELETE FROM pertenece WHERE ids = :ids AND idg in (SELECT idg FROM genero WHERE genero = :genero)");
        try{
            $query->execute([
                'ids'=>$item['ids'],
                'genero'=>$item['genero'],
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }



    }

    //añade una relación entre género y serie
    /**
     * aquí me dió un montón de problemas la query de insert, quería hacerlo todo de una con un select pero no dejaba de fallar.
     */
    public function add($item) {


        $query2 = $this->db->connect()->prepare("SELECT idg FROM genero WHERE genero = :genero");
        $query2->execute([
            'genero'=>$item['genero'],
        ]);

        while ($row = $query2->fetch()){

            $genero = $row[0];

        }

        $ids = $item['ids'];

        $query = $this->db->connect()->prepare("INSERT INTO pertenece VALUES ($ids, $genero)");

        try{
            $query->execute();

            return true;
        }catch(PDOException $e){
            return false;
        }

    }

    public function newGenero($item) {

        $query = $this->db->connect()->prepare("INSERT INTO genero (genero) VALUES (:genero)");

        try{
            $query->execute([
                ':genero'=>$_POST['nuevogen'],
            ]);

            $this->add($item);

            return true;
        }catch(PDOException $e){
            return false;
        }

    }


}

?>