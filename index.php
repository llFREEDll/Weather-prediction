<!--

Sierra Mendoza Alfredo
Pagina que da preddicciones de tiempo basado en el contenido de otra pagina web
28-12-2020

-->
<?php
$output = "";
$error = "";
if ($_GET) {

  $cuiudad = str_replace(" ","",$_GET["city"]);
  //exite la url?
  $file = "https://es.weather-forecast.com/locations/".$cuiudad."/forecasts/latest";
  $file_headers = @get_headers($file);
  if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
      $error = "No hemos podido encontrar esa ciudad";
  }
  else {
    $paginaForecast = file_get_contents($file);
     $array = explode("</h2> (1&ndash;3 días)</div><p class=\"b-forecast__table-description-content\"><span class=\"phrase\">",$paginaForecast);
     if (sizeof($array) > 1) {
       $array2 = explode("</span>",$array[1]);
       if (sizeof($array2) > 0) {
         $output = $array2[0];
       }else {
         $error = "No hemos podido encontrar esa ciudad";
       }

     }else {
       $error = "No hemos podido encontrar esa ciudad";
     }

  }

}


 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style type="text/css">
      html {
          background: url("https://images.unsplash.com/photo-1608122798528-a50e2db004a8?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80") no-repeat center center fixed;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
      }
      body{

          background:none;
      }
      .container{
        text-align: center;
        margin-top: 200px;
        width: 100%;
      }
      input{
        margin-left: 25%;
      }
      #output{
          margin-top: 30px;
          margin-left: 25%;
      }
    </style>
    <title>Weather</title>
  </head>
  <body>
    <div class="container">
      <h1 class="text-white">Weather prediction!</h1>
      <form class="">
        <div class="form-group mx-auto">
          <label for="city" class="text-white">City:</label>
          <input type="text" class="form-control w-50" id="city" name="city" aria-describedby="emailHelp" placeholder="Ej. México city">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>

      </form>
      <div id="output" class="w-50">
        <?php
          if ($error != "") {
            echo "<div class=\"alert alert-danger\" role=\"alert\">".
              $error.
            "</div>";
          }
          else if ($output != ""){
            echo "<div class=\"alert alert-success\" role=\"alert\">".
              $output.
            "</div>";
          }

         ?>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>
