<?php

  include_once 'Requester.php';

  // Manage AjaxResponse
  if ($_SERVER['REQUEST_URI'] == '/justTable') {

    $data = [];
    foreach ($_POST as $key => $element) {
      if(!empty($element)) {
        $data[$key] = $element;
      }
    }
    $requester = new Requester($data);
      try {
          print $requester->getHtml();
      } catch (\Exception $e) {
          // simple error management.
        print '<p class="error">Ajax Error.</p>';
        exit;
      }
      exit;
  }
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" dir="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="/js/myscript.js"></script>
  <style>.error{color:red;}</style>
</head>
<body>

<form method="POST">
  <fieldset>
    <label for="distrito_nombre">Filtrar por distrito</label>
    <select class="parameter " name="distrito_nombre">
      <option selected="" value=""></option>
      <option value="ARGANZUELA"> ARGANZUELA  </option>
      <option value="BARAJAS"> BARAJAS  </option>
      <option value="CARABANCHEL"> CARABANCHEL  </option>
      <option value="CENTRO"> CENTRO  </option>
      <option value="CHAMARTIN"> CHAMARTIN  </option>
      <option value="CHAMBERI"> CHAMBERI  </option>
      <option value="CIUDAD LINEAL"> CIUDAD LINEAL  </option>
      <option value="FUENCARRAL-EL PARDO"> FUENCARRAL-EL PARDO  </option>
      <option value="HORTALEZA"> HORTALEZA  </option>
      <option value="LATINA"> LATINA  </option>
      <option value="MONCLOA-ARAVACA"> MONCLOA-ARAVACA  </option>
      <option value="MORATALAZ"> MORATALAZ  </option>
      <option value="PUENTE DE VALLECAS"> PUENTE DE VALLECAS  </option>
      <option value="RETIRO"> RETIRO  </option>
      <option value="SALAMANCA"> SALAMANCA  </option>
      <option value="SAN BLAS-CANILLEJAS"> SAN BLAS-CANILLEJAS  </option>
      <option value="TETUAN"> TETUAN  </option>
      <option value="USERA"> USERA  </option>
      <option value="VICALVARO"> VICALVARO  </option>
      <option value="VILLA DE VALLECAS"> VILLA DE VALLECAS  </option>
      <option value="VILLAVERDE"> VILLAVERDE  </option>
    </select>
  </fieldset>
  <fieldset>
    <label for="latitud">Latitud:</label><input class="parameter" minlength="0" name="latitud" placeholder="" type="text" value="">
    <label for="longitud">Longitud:</label><input class="parameter" minlength="0" name="longitud" placeholder="" type="text" value="">
    <label for="distancia">Distancia:</label><input class="parameter" minlength="0" name="distancia" placeholder="" type="text" value="">
  </fieldset>
  <fieldset>
    <input type="submit" value="filter" />
  </fieldset>
</form>

<div id="result">
<?php
  $requester = new Requester();
  print $requester->getHTML();
?>
</div>
</body>
