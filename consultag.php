<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registro de información en firebase</title>
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
        <center> <img src="imagenes/logo_robo.png" alt="Imagen de Registro"></center>
        </div>
        <?php
        // URL de tu base de datos de Firebase Realtime Database
        $url = 'https://act5y6-iw-default-rtdb.firebaseio.com/registro.json'; // Asegúrate de que esta URL sea correcta

        // Inicializar cURL
        $ch = curl_init();

        // Configurar cURL para hacer una solicitud GET
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para devolver el resultado de la solicitud
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desactivar verificación SSL si es necesario

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        // Verificar si hubo algún error en la solicitud cURL
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            // Decodificar la respuesta JSON
            $data = json_decode($response, true);

            if ($data) {
                // Mostrar los datos obtenidos
                echo '<center>
                      <h2>Datos registrados</h2>
                      </center>';
                echo '<ul>';

                // Iterar a través de los registros y mostrarlos
                foreach ($data as $key => $record) {
                    echo '<li>';
                    echo 'Proyecto: ' . htmlspecialchars($record['Proyecto']) . '<br>';
                    echo 'Tarea: ' . htmlspecialchars($record['Tarea']) . '<br>';
                    echo 'Subtarea: ' . htmlspecialchars($record['Subtarea']) . '<br>';
                    echo 'Responsable: ' . htmlspecialchars($record['Responsable']) . '<br>';
                    echo '</li>';
                }

                echo '</ul>';
                echo '
                    <center>
                    Datos Consultados
                    <br>
                    <br>
                    <a href="index.html" class="btn btn-primary btn-lg">Volver a la página principal</a>
                    </center>
                ';
            } else {
                echo 'No se encontraron registros.';
            }
        }

        // Cerrar cURL
        curl_close($ch);
        ?>
        
      </div>
    </div>
</div>
