<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de información en firebase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background-color: #d8f2e2; /* Fondo en azul claro */
    }
    .container {
      max-width: 600px;
      margin-top: 50px;
    }
    .card {
      background-color: #ffffff; /* Fondo de la tarjeta en un azul suave */
    }
    .btn-primary {
      background-color: #01531c; /* Azul más oscuro */
      border-color: #0277bd;
    }
    .btn-primary:hover {
      background-color: #0277bd; /* Hover en azul más oscuro */
      border-color: #01579b;
    }
    .form-control:focus {
      border-color: #0288d1;
      box-shadow: 0 0 0 0.2rem rgba(2, 136, 209, 0.25);
    }
    label {
      color: #17461ed7; /* Color azul oscuro para los textos */
    }
  </style>
</head>
<body>
<div class="container">
    <div class="card">
      <div class="card-header text-center">
        <h4>Registro a base de datos firebase</h4>
      </div>
      <div class="card-body">
        <div class="img-container">
        <center><img src="imagenes/logo_robo.png" alt="Imagen de Registro"></center>
        </div>
        <?php
            //recolectar información del formulario
            $proyecto = $_POST["proyecto"];
            $tarea = $_POST["tarea"];
            $subtarea = $_POST["subtarea"];
            $responsable = $_POST["responsable"];
            // Crear vector de almacenamiento en firebase
            $data = '{"Proyecto":"'.$proyecto.'","Tarea":"'.$tarea.'","Subtarea":"'.$subtarea.'",
            "Responsable":"'.$responsable.'"}';
            // Url de firebase de realtime
            $url = 'https://act5y6-iw-default-rtdb.firebaseio.com/registro.json';
            // Inicio de comunicación por curl
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: text/plain'));

            $response = curl_exec($ch);
            if(curl_errno($ch))
            {
                echo 'Error:'.curl_errno($ch);
            }
            else
            {
                echo '
                    <center>
                    Datos insertados
                    <br>
                    <br>
                    <a href="registro.html" class="btn btn-primary btn-lg">Volver a la página principal</a>
                    </center>
                ';
            }
        ?>
      </div>
    </div>
</div>
</body>
</html>