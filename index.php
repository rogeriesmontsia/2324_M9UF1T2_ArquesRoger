<?php
session_start();
include 'includes/functions.php';
inicialitzarHistorial();
#xdebug_info();

$operation = '';
if (isset($_POST['calcular'])) {
  $input1 = $_POST['input1'];
  $input2 = $_POST['input2'];
  $operation = $_POST['operacio'];
  $result = '';
}

include 'Calculadora.php';
$calculator = new Calculadora();
switch ($operation) {
  case '+':
    $result = $calculator->sumar($input1, $input2);
    break;
  case '-':
    $result = $calculator->restar($input1, $input2);
    break;
  case '*':
    $result = $calculator->multiplicar($input1, $input2);
    break;
  case '/':
    $result = $calculator->dividir($input1, $input2);
    break;
  case 'concatenate':
    $result = $calculator->concatenar($input1, $input2);
    break;
  case 'eliminar':
    $result = $calculator->eliminar($input1, $input2);
    break;
  case 'factorial':
    $result = $calculator->calcularFactorial($input1);
    break;
  default:
    $result = 'Operació no vàlida';
}

//Llimpia l'historial fent clic al botó
if (isset($_POST['llimpiar_historial'])) {
  llimpiarHistorial();
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calculadora🧙‍♂️</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>
<header class="bg-primary fs-1 fw-bold bg-gradient py-3 text-center">
  <h1>Calculadora🧙‍♂️</h1>
</header>

<body class="bg-info bg-gradient">
  <!--Seccio per al formulari-->
  <section class="container mt-0">
    <div class="row justify-content-center">
      <div class="text-center col-10 col-sm-10 col-md-7 col-lg-6 col-xl-5 p-5"> 
        <form class="formulariInputs" method="POST">
          <input type="text" id="input1" name="input1" class="form-control" placeholder="Primer valor">
          <label for="operacio">Operació a realitzar:</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="suma" name="operacio" value="+" class="form-check-input" checked>
            <label for="operacio" class="form-check-label pl-2">➕</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="resta" name="operacio" value="-" class="form-check-input">
            <label for="operacio" class="form-check-label pl-2">➖</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="multiplicacio" name="operacio" value="*" class="form-check-input">
            <label for="operacio" class="form-check-label pl-2">✖️</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="divisio" name="operacio" value="/" class="form-check-input">
            <label for="operacio" class="form-check-label pl-2">➗</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="factorial" name="operacio" value="factorial" class="form-check-input">
            <label for="operacio" class="form-check-label pl-2">❗</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="concatena" name="operacio" value="concatena" class="form-check-input">
            <label for="operacio" class="form-check-label pl-2">Concatenar strings</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="elimina" name="operacio" value="eliminar" class="form-check-input">
            <label for="operacio" class="form-check-label pl-2">Eliminar part string</label>
          </div>
          <input type="text" id="input2" name="input2" class="form-control" placeholder="Segon valor">
          <button type="submit" class="form-control btn btn-primary mt-3" name="calcular">Calcular🪄</button>
        </form>
      </div>
    </div>
  </section>
  <!--Seccio per a l'ALERTA-->
  <?php
  if (isset($_POST['calcular']) && ($result != 'Operació no vàlida')) {
    mostrarResultat($result);
    $operacioRealitzada = "$input1 $operation $input2 = $result";
    array_push($_SESSION['history'], $operacioRealitzada);
  } else {
    include 'includes/errorHandling.php';
  }
  ?>

  <!--Seccio per a l'historial-->
  <section class="container-fluid mt-0">
    <section class="d-flex justify-content-center align-items-center p-3">
      <h2>📜Historial d'operacions📜</h2>
      <form method="POST">
        <button class="botoEliminar btn" type="submit" name="llimpiar_historial" title="Eliminar historial">
          <h1>🗑️</h1>
        </button>
      </form>
    </section>
  </section>


  <div class="container-fluid">
  <div class="row justify-content-center align-items-center p-3">
    <?php 
    mostrarHistorial(); 
    ?>
  </div>
  </div>
</body>
</html>