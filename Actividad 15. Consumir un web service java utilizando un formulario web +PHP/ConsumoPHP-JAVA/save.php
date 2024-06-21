<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Save</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="text-center mb-4">Registrar Usuario</h2>
                    <form method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="apellido">Apellidos:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" name="guardar">Enviar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS (opcional, para ciertas características como dropdowns) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    </body>

</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];

    try {
        // URL del archivo WSDL del servicio web
        $wsdl_url = 'http://localhost:8089/EjemploWebService/procesoWebService?wsdl';

        // Crear el cliente SOAP
        $client = new SoapClient($wsdl_url);

        // Definir los parámetros para el método del servicio web
        $params = array(
            'arg0' => $nombre,
            'arg1' => $apellido,
            'arg2' => $email,
        );

        // Llamar al método del servicio web
        $return = $client->save($params);

        // Mostrar el resultado, var_dump para visualización detallada
        //echo "<pre>";
        //var_dump($return);
        //echo "</pre>";
    } catch (Exception $e) {
        echo "Exception occurred: " . $e->getMessage();
    }
}
?>







