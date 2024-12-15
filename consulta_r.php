<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar registro específico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #d8f2e2; /* Fondo azul claro */
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
            <h4>Consultar proyecto específico</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="proyecto" class="form-label">Proyecto:</label>
                    <input type="text" class="form-control" id="proyecto" name="proyecto" placeholder="Ingrese el nombre del proyecto" required>
                </div>
                <center><button type="submit" class="btn btn-primary">Consultar</button></center>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Obtener el valor del campo 'usuario' del formulario
                $proyecto = $_POST['proyecto'];

                // URL de tu base de datos de Firebase Realtime Database
                $url = 'https://act5y6-iw-default-rtdb.firebaseio.com/registro.json'; // Reemplaza con tu URL

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

                    $registroEncontrado = false;
                    // Buscar el registro con el usuario ingresado
                    foreach ($data as $key => $record) {
                        if (strcasecmp($record['Proyecto'], $proyecto) == 0) {
                            $registroEncontrado = true;
                            echo '<br>';
                            echo '<center><h2>Registro Encontrado</h2></center>';
                            echo '<ul>';
                            echo '<li>Proyecto: ' . htmlspecialchars($record['Proyecto']) . '</li>';
                            echo '<li>Tarea: ' . htmlspecialchars($record['Tarea']) . '</li>';
                            echo '<li>Subtarea: ' . htmlspecialchars($record['Subtarea']) . '</li>';
                            echo '<li>Responsable: ' . htmlspecialchars($record['Responsable']) . '</li>';
                            echo '</ul>';
                            break;
                        }
                    }

                    if (!$registroEncontrado) {
                        echo '<p>No se encontraron registros con el nombre de proyecto: ' . htmlspecialchars($proyecto) . '</p>';
                    }
                    echo '
                    <br>
                    <center>
                    Datos Consultados
                    <br>
                    <br>
                    <a href="index.html" class="btn btn-primary btn-lg">Volver a la página principal</a>
                    </center>
                ';
                }

                // Cerrar cURL
                curl_close($ch);
            }
            ?>

        </div>
    </div>
</div>

</body>
</html>
