<?php
// Inicializar variables para valores de campos de texto
$id_mostrado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    // Procesar el formulario
    $usuario_id = $_POST['usuario_id'];

    try {
        $wsdl_url = 'http://localhost:8089/EjemploWebService/procesoWebService?wsdl';
        $client = new SOAPClient($wsdl_url);
        $params = array(
            'arg0' => "$usuario_id",
        );
        $return = $client->searchUser($params);
    } catch (Exception $e) {
        echo "Exception occurred: " . $e;
    }
}
?>

<?php
// Inicializar variables para valores de campos de texto
$nombre = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    // Procesar el formulario de búsqueda
    $usuario_id = $_POST['usuario_id'];

    try {
        $wsdl_url = 'http://localhost:8089/EjemploWebService/procesoWebService?wsdl';
        $client = new SOAPClient($wsdl_url);
        $params = array(
            'arg0' => $usuario_id,
        );
        $return = $client->mostrarNombre($params);

        // Asumimos que el método mostrarNombre devuelve un objeto con una propiedad llamada 'return'
        if (isset($return->return)) {
            $nombre = htmlspecialchars($return->return);
        } else {
            $nombre = ''; // Si no se encontró el nombre, dejar el campo vacío
        }
    } catch (Exception $e) {
        echo "Exception occurred: " . $e->getMessage();
    }
}
?>

<?php
// Inicializar variables para valores de campos de texto
$apellido = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    // Procesar el formulario de búsqueda
    $usuario_id = $_POST['usuario_id'];

    try {
        $wsdl_url = 'http://localhost:8089/EjemploWebService/procesoWebService?wsdl';
        $client = new SOAPClient($wsdl_url);
        $params = array(
            'arg0' => $usuario_id,
        );
        $return = $client->mostrarApellidos($params);

        // Asumimos que el método mostrarApellidos devuelve un objeto con una propiedad llamada 'return'
        if (isset($return->return)) {
            $apellido = htmlspecialchars($return->return);
        } else {
            $apellido = ''; // Si no se encontró el apellido, dejar el campo vacío
        }
    } catch (Exception $e) {
        echo "Exception occurred: " . $e->getMessage();
    }
}
?>

<?php
// Inicializar variables para valores de campos de texto
$correo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    // Procesar el formulario de búsqueda
    $usuario_id = $_POST['usuario_id'];

    try {
        $wsdl_url = 'http://localhost:8089/EjemploWebService/procesoWebService?wsdl';
        $client = new SOAPClient($wsdl_url);
        $params = array(
            'arg0' => $usuario_id,
        );
        $return = $client->mostrarCorreo($params);

        // Asumimos que el método mostrarCorreo devuelve un objeto con una propiedad llamada 'return'
        if (isset($return->return)) {
            $correo = htmlspecialchars($return->return);
        } else {
            $correo = ''; // Si no se encontró el correo, dejar el campo vacío
        }
    } catch (Exception $e) {
        echo "Exception occurred: " . $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>update</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Actualizar Usuario</h2>

                <form method="post">
                    <div class="form-group">
                        <label for="usuario_id">ID de Usuario:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="usuario_id" name="usuario_id">
                            <div class="input-group-append">
                                <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- ID -->
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
                    // Procesar el formulario de búsqueda
                    $usuario_id = $_POST['usuario_id'];

                    try {
                        $wsdl_url = 'http://localhost:8089/EjemploWebService/procesoWebService?wsdl';
                        $client = new SOAPClient($wsdl_url);
                        $params = array(
                            'arg0' => $usuario_id,
                        );
                        $return = $client->mostrarId($params);

                        // Asumimos que el método mostrarId devuelve un objeto con una propiedad llamada 'return'
                        if (isset($return->return)) {
                            $id_mostrado = htmlspecialchars($return->return);
                        } else {
                            $id_mostrado = ''; // Si no se encontró el ID, dejar el campo vacío
                        }
                    } catch (Exception $e) {
                        echo "Exception occurred: " . $e->getMessage();
                        $id_mostrado = ''; // Manejar la excepción y dejar el campo vacío
                    }
                } else {
                    $id_mostrado = ''; // Por defecto, dejar el campo vacío si no se ha enviado el formulario
                }
                ?>








                <!-- FORM MOSTRAR DATOS -->
                <form method="post">


                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" id="id" name="id" required value="<?php echo $id_mostrado; ?>">
                    </div>


                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo $nombre; ?>">
                    </div>

                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required value="<?php echo $apellido; ?>">
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo electrónico:</label>
                        <input type="correo" class="form-control" id="email" name="correo" required value="<?php echo $correo; ?>">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block mb-3" name="actualizar" onclick="<?php
                                                                                                                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
                                                                                                                            $id = $_POST['id'];
                                                                                                                            $nombre = $_POST['nombre'];
                                                                                                                            $apellido = $_POST['apellidos'];
                                                                                                                            $email = $_POST['correo'];


                                                                                                                            try {
                                                                                                                                $wsdl_url = 'http://localhost:8089/EjemploWebService/procesoWebService?wsdl';
                                                                                                                                $client = new SOAPClient($wsdl_url);
                                                                                                                                $params = array(
                                                                                                                                    'arg0' => $id,
                                                                                                                                    'arg1' => $nombre,
                                                                                                                                    'arg2' => $apellido,
                                                                                                                                    'arg3' => $email,
                                                                                                                                );
                                                                                                                                $return = $client->update($params);
                                                                                                                                print_r($return);
                                                                                                                            } catch (Exception $e) {
                                                                                                                                echo "Exception occured: " . $e;
                                                                                                                            }
                                                                                                                        }
                                                                                                                        ?>">Actualizar</button>
                    </div>

                </form>


            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para ciertas características como dropdowns) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>