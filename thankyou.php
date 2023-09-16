<!doctype html>
<html>
    <head>
        <title>Thank You</title>
    </head>
    <body>
    

        <h1>Thank You</h1>

        <?php
            $idCaso = $_GET['idCaso'];
            $clienteName = $_GET['clienteName'];
            $departamento = $_GET['departamento'];
            $empleado = $_GET['empleado'];

                echo "Gracias por tu mensaje, $clienteName. 
                Has contactado al departamento de $departamento y serás atendido por $empleado. Tu número de caso es $idCaso.";
        ?>

    </body>
</html>
