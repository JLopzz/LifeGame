<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Juego de la Vida</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="./style.css">
</head>
<body class ='bg-dark'>
  <div class="col-md-12 col-lg-10 offset-lg-1 row mt-2">
    <div class="col-sm-12 col-md-8 d-flex flex-column">
      <div class="d-block d-md-none">
        <h1 class="text-light text-center">Juego de la Vida</h1>
      </div>
      <div class="d-flex justify-content-center">
      <table>
        <?php
          $max = 125;
          for ($y=0; $y < $max; $y++) { 
            echo "<tr>\n";
            for ($x=0; $x < $max; $x++) { 
              if(
                (($x >= 58 && $x <= 60) && $y == 51) ||
                (($x == 58 || $x == 61) && $y == 52) ||
                ($x == 58               && ($y >= 53 && $y <= 56)) ||
                ($x == 61               && $y == 56)
              ) echo "<td neigh='1' name='tds' class='false' id='$x-$y'></td>\n";
              else if(
                ($x == 60               && ($y == 52 || $y == 56)) ||
                ($x == 61               && ($y == 53 || $y == 55 )) ||
                ($x == 59               && $y == 56)
              ) echo "<td neigh='2' name='tds' class='false' id='$x-$y'></td>\n";
              else if(
                ($x == 59               && $y == 53) ||
                ($x == 61               && $y == 54)
              ) echo "<td neigh='3' name='tds' class='false' id='$x-$y'></td>\n";
              else if(
                $x == 59                && $y == 54
              ) echo "<td neigh='4' name='tds' class='false' id='$x-$y'></td>\n";
              else if(
                $x == 59                && $y == 52
              ) echo "<td neigh='1' name='tds' class='true' id='$x-$y'></td>\n";
              else if(
                ($x == 60               && ($y == 53 || $y == 55)) ||
                ($x == 59               && $y == 55)
              ) echo "<td neigh='2' name='tds' class='true' id='$x-$y'></td>\n";
              else if(
                $x == 60                && $y == 54
              ) echo "<td neigh='3' name='tds' class='true' id='$x-$y'></td>\n";
              else echo "<td neigh='0' name='tds' class='false' id='$x-$y'></td>\n";
            }
            echo "</tr>\n";
          }
        ?>
      </table>
      </div>
    </div>
    <div class="d-none d-md-block col-md-4 row m-0 px-2">
      <h1 class= 'text-light text-center'>Juego de la Vida</h1>
      <div class="col-12 row">
        <div class="col-7">
          <label for="itera" class='text-light text-left'>Numero de Generaciones:</label>
          <input type="text" id="itera" name="itera" class='form-control mb-3' placeholder='Generaciones' value=200>
        </div>
        <div class="col-5 roy my-auto p-0">
          <button onclick="each()" class='btn btn-secondary col-12 mb-1'>Iniciar</button>
          <a href="./" class='btn btn-primary col-12'>Limpiar</a>
        </div>
      </div>
      <div class='col-12'>
        <label for="itera" class='text-light text-right mb-0' id='gen'>Generacion: 0</label><br>
        <label for="itera" class='text-light text-right mb-2' id='alive'>Celulas Vivas: 5</label>
      </div>
      <div class="col-12 p-0">
        <h3 class="text-light">Instrucciones:</h3>
        <p class="text-light text-justify mb-2">Haz clic en el tablero para revivir las celulas, revive cuantas quieras.</p>
        <p class="text-light text-justify mb-2">Ahora asigna la cantidad de generaciones que deseas ver en el cuadro de texto, y haz click en <kbd>Iniciar</kbd>.</p>
        <p class="text-light text-justify mb-2">Y observa como se comportan las celulas a lo largo de las generaciones que pasen.</p>
        <h3 class="text-light">Reglas del Juego:</h3>
        <p class="text-light text-justify mb-2">1. La Celula que esté muerta, pero tiene 3 vecinas vivas, vuelve a vivir</p>
        <p class="text-light text-justify mb-2">2. La celula que esté viva, pero que tenga menos que 2 o mas que 3 vecinos vivos, se muere.</p>
        <p class="text-light text-right">Visualizar codigo fuente en <a class='text-info' href="https://github.com/JLopzz/LiveGame">GitHub</a></p>
        <footer class="blockquote-footer text-light">Hecho por <a href="https://github.com/JLopzz" class="text-light"><cite title="Source Title">JLopzz</cite></a></footer>
      </div>
    </div>
    <div class="col-sm-12 d-block d-md-none my-3">
      <div class="row">
        <div class="col-10 offset-1 row">
          <input type="text" id="iteraCel" name="itera" class='form-control col-7 m-auto' placeholder='Numero de Generaciones' value=200>
          <div class="col-5 row m-auto">
            <button onclick="each()" class='btn btn-secondary col-12 mb-1'>Iniciar</button>
            <a href="./" class='btn btn-primary col-12'>Limpiar</a>
          </div>
          <div class="col-12 row mx-auto my-3">
            <label for="itera" class='text-light text-center col-6' id='genCel'>Generacion: 0</label>
            <label for="itera" class='text-light text-center col-6' id='aliveCel'>Celulas Vivas: 5</label>
          </div>
        </div>
        <div class="col-10 offset-1">
          <h3 class="text-light mt-3">Instrucciones:</h3>
          <p class="text-light text-justify">Haz clic en el tablero para revivir las celulas, revive cuantas quieras.</p>
          <p class="text-light text-justify">Ahora asigna la cantidad de generaciones que deseas ver en el cuadro de texto, y haz click en <kbd>Iniciar</kbd>.</p>
          <p class="text-light text-justify">Y observa como se comportan las celulas a lo largo de las generaciones que pasen.</p>
          <h3 class="text-light">Reglas del Juego:</h3>
          <p class="text-light text-justify">1. La Celula que esté muerta, pero tiene 3 vecinas vivas, vuelve a vivir</p>
          <p class="text-light text-justify">2. La celula que esté viva, pero que tenga menos que 2 o mas que 3 vecinos vivos, se muere.</p>
        <p class="text-light text-right">Visualizar codigo fuente en <a class='text-info' href="https://github.com/JLopzz/LiveGame">GitHub</a></p>
        <footer class="blockquote-footer text-light">Hecho por <a href="https://github.com/JLopzz" class="text-light"><cite title="Source Title">JLopzz</cite></a></footer>
        </div>
      </div>
    </div>
  </div>
  <script src="./liveGame.js"></script>
</body>
</html>
