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

<div id="info">
    <form method="POST" action="http://localhost/ejercicios/recuperacion/misseries/consulta/updateSerie/<?php echo $this->serie->titulo ?>">
        <div class="form-group row" style="margin: 10px; width: 50%">
            <label for="fecha" class="col-sm-2 col-form-label"><b>Fecha de estreno:</b></label>
            <div class="col-sm-10">
            <input type="date" class="form-control" name="fecha" value="<?php echo $this->serie->fecha ?>">
            </div>
        </div>
        <div class="form-group row" style="margin: 10px; width: 50%">
            <label for="temps" class="col-sm-2 col-form-label"><b>Temporadas:</b></label>
            <div class="col-sm-10">
            <input type="number" class="form-control" name="temps" value="<?php echo $this->serie->temporadas ?>">
            </div>
        </div>
        <div class="form-group row" style="margin: 10px; width: 50%">
            <label for="punt" class="col-sm-2 col-form-label"><b>Puntuacion:</b></label>
            <div class="col-sm-10">
            <input type="number" step="any" max="10" min="0" class="form-control" name="punt" value="<?php echo $this->serie->puntuacion ?>">
            </div>
        </div>
        <div class="form-group row" style="margin: 10px; width: 50%">
            <label for="" class="col-sm-2 col-form-label"><b>Géneros:</b></label>
            <div class="col-sm-10">
                <p style="font-size: 1.5vw">
                <?php 
                    foreach($this->serie->generos as $index => $aux) {

                        echo $aux;
                        if (!($index === array_key_last($this->serie->generos))) {
                            echo ", ";
                        }
    
                    }
                ?>
                <a href="<?php echo 'http://localhost/ejercicios/recuperacion/misseries/' . 'consulta/actualizarSerie/' . $this->serie->titulo; ?>" style="float: right">Gestionar géneros</a>
                </p>
            </div>
        </div>
        <div class="form-group row" style="margin: 10px; width: 50%">
            <label for="argu" class="col-sm-2 col-form-label"><b>Argumento:</b></label>
            <textarea class="form-control" name="argu" rows="10"><?php echo $this->serie->argumento ?></textarea>
        </div>
        <button type="submit" class="btn btn-secondary btn-sm" style="margin-left: 40%">Actualizar información</button>
    </form>

    <?php echo $this->mensaje ?>


</div>


</body>
</html>