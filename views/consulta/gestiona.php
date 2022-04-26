<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="http://localhost/ejercicios/recuperacion/misseries/public/css/default.css">
</head>
<body>



<br/>

<p style="font-size: 70px">mis Series</p>
<h2><b><?php echo $this->serie->titulo ?></b></h2>


<a href="http://localhost/ejercicios/recuperacion/misseries/">Mis series</a>
<i class="bi bi-slash-lg"></i>
<a href="<?php echo 'http://localhost/ejercicios/recuperacion/misseries/' . 'consulta/verSerie/' . $this->serie->titulo; ?>">Volver atrás</a>

<br/><br/>



<table class="table" style="width:35%">
  <thead class="thead-dark" style="background-color: black ; color: white">
    <tr>
      <th scope="col">Género</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>


  

        
  <?php 


//define('GENEROS', ['Comedia', 'Aventura', 'Thriller', 'Terror', 'Drama', 'Ciencia Ficción', 'Fantasía', 'Animación']);

        foreach($this->serie->generos as $aux) {
        

            ?>
            <tr>
            <td>
            <?php 

            echo $aux ;
            ?>
            
            <td>
            <a href="http://localhost/ejercicios/recuperacion/misseries/consulta/deleteGenero/<?php echo $this->serie->titulo ?>/<?php echo $aux ?>">Borrar</a>
            </td>
            </tr>
            <?php

        }
            
        ?>

        <tr>
            <td>
                <form action="http://localhost/ejercicios/recuperacion/misseries/consulta/addGenero/<?php echo $this->serie->titulo ?>" method="post">

                    <select name="genero" id="genero">
                        <option value="nada" selected="selected">Elige un género</option>

                        <?php

                        

                            foreach($this->generos as $genero){

                                if(!in_array($genero, $this->serie->generos)) {

                                    ?>

                                    <option value="<?php echo $genero?>"><?php echo $genero?></option>

                                    <?php

                                }

                            }



                        ?>

                        <option value="nuevo" >Nuevo género</option>

                    </select>

                    <?php 

                        if($this->mensaje=="nuevo") {

                            $this->mensaje="";

                            ?>
                            
                            <input type="text" name="nuevogen" id="nuevogen" placeholder="Introduce un género">

                            <?php 

                        }
                    ?>

                    </td>

                    

                    <td>
                        <!-- Me da problemas hacerlo con un href, no se por qué pero no me coge bien el name del selector genero -->
                        <button type="submit">Añadir</button>
                    </td>

                </form>

            
        </tr>


  </tbody>
</table>

<?php echo $this->mensaje;?>

</body>
</html>