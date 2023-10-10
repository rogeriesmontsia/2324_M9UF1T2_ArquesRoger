<?

function inicialitzarHistorial()
{
  // Inicialitza l'array de l'historial si encara no existeix
  if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = array();
  }
}

function mostrarHistorial()
{
  // Obtenim el total d'operacions realitzades
  $total_operacions = count($_SESSION['history']);
  // Itera a través del historial en ordre invers
  for ($i = $total_operacions - 1; $i >= 0; $i--) {
    $operacio = $_SESSION['history'][$i];
    echo "$operacio<br><hr class=\"border border-primary border-1 opacity-75\">";
  }
}

function mostrarResultat($result)
{
  echo "<div class=\"container mt-0 text-center\">";
  echo "<div class=\"row justify-content-center\">";
  echo "<div class=\"col-10 col-md-8 col-lg-6 badge bg-warning-subtle text-center p-3 rounded text-black text-wrap\">";
  echo "<h2>🥁 Resultat 🥁</h2>";
  echo "<h1>$result</h1>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
}

function mostrarAlerta($message)
{
  //echo "<div class=\"container mt-0 border border-secondary\">";
  //echo "<div class=\"row justify-content-center align-items-center border border-secondary\">";
  echo "<div class=\"alert alert-danger text-center\" role=\"alert\">";
  echo $message;
  echo "</div";
  //echo "</div";
  //echo "</div";
}

function llimpiarHistorial()
{
  $_SESSION['history'] = array();
}
