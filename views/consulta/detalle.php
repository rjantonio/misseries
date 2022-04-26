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

<br/>

<a href="http://localhost/ejercicios/recuperacion/misseries/">Mis series</a>

<br/><br/>



<div id="serie">
    <div id="imagen">

        <img src="<?php echo $this->serie->poster ?>" alt="" height="500px">

    </div>
    
    <div id="texto">

        <h2><?php echo $this->serie->titulo ?></h2>
        <p><?php echo $this->serie->plataforma ?></p>
        <br/>
        <p>
            <b>Fecha de estreno:</b>
            <class id="texdere">
                <?php 
                    //echo $this->serie->fecha 
                    $fecha1 = explode("-",  $this->serie->fecha );
                    
                    switch($fecha1[1]) {
                        case 1:
                            $fecha1[1] = "enero";
                            break;
                        case 2:
                            $fecha1[1] = "febrero";
                            break;
                        case 3:
                            $fecha1[1] = "marzo";
                            break;
                        case 4:
                            $fecha1[1] = "abril";
                            break;
                        case 5:
                            $fecha1[1] = "mayo";
                            break;
                        case 6:
                            $fecha1[1] = "junio";
                            break;
                        case 7:
                            $fecha1[1] = "julio";
                            break;
                        case 8:
                            $fecha1[1] = "agosto";
                            break;
                        case 9:
                            $fecha1[1] = "septiembre";
                            break;
                        case 10:
                            $fecha1[1] = "octubre";
                            break;
                        case 11:
                            $fecha1[1] = "noviembre";
                            break;
                        case 12:
                            $fecha1[1] = "diciembre";
                            break;
                    }
                    echo $fecha1[2] . " de " . $fecha1[1] . " del " . $fecha1[0];
                ?>
            </class>
        </p>
        <p>
            <b>Temporadas:</b>
            <class id="texdere">
                <?php echo $this->serie->temporadas ?>
            </class>
        </p>
        <p>
            <b>Puntuación:</b>
            <class id="texdere">
                <?php echo number_format($this->serie->puntuacion, 2, '.', '');?>
            </class>
        </p>
        
        <p>
            <?php echo $this->serie->argumento ?>
        </p>

        <br/>

        <div id="generos">
            <?php 

                foreach($this->serie->generos as $index => $aux) {

                        echo $aux;
                        if (!($index === array_key_last($this->serie->generos))) {
                            echo ", ";
                        }
    
                    }
            
            ?>
        </div>
        
        

    </div>

    
    
</div>

<div id="opciones">
    <a href="http://localhost/ejercicios/recuperacion/misseries/">Volver atrás</a>
    <i class="bi bi-slash-lg"></i>
    <a href="<?php echo 'http://localhost/ejercicios/recuperacion/misseries/' . 'consulta/actualizarSerie/' . $this->serie->titulo; ?>">Gestionar géneros</a>
    <i class="bi bi-slash-lg"></i>
    <a href="<?php echo 'http://localhost/ejercicios/recuperacion/misseries/' . 'consulta/editarSerie/' . $this->serie->titulo; ?>">Editar serie</a>
</div>


</body>
</html>