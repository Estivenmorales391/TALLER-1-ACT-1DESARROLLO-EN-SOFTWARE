<?php

$connect = mysqli_connect('localhost', 'root', '', 'taller2');

$email = isset($_POST['email']) ?$_POST['email'] : '';
$message = isset($_POST['message']) ?$_POST['message'] : '';
$clienteName = isset($_POST['clienteName']) ?$_POST['clienteName'] : '';
$departamento = isset ($_POST['departamento'] );
$empleadoName = isset($_POST['empleadoName']) ;

$email_error = '';
$message_error = '';
$clienteName_error = '';
$departamento_error = '';
$empleadoName_error = '';


if (count($_POST))
{
    $errors =  0;

    if ($_POST['email'] == '')
    {
        $email_error = 'Please enter an email address';
        $errors ++;
    }

    if ($_POST['message'] == '')
    {
        $message_error = 'Please enter a message';
        $errors ++;
    }

    if ($_POST['clienteName'] == '')
    {
        $clienteName_error = 'Please enter a name';
        $errors ++;
    }

    if ($_POST['departamento'] == '')
    {
        $departamento_error = 'Please enter a department';
        $errors ++;
    }
    
        $atencionCliente = [
        "Lionel Messi",
        "Cristiano Ronaldo",
        "Diego Maradona",
        "Pele"
        ];
    
        $soporteTecnico = [
        "Homero Simpson",
        "Lisa Simpson",
        "Bart Simpson",
        "Marge Simpson"
        ];
    
        $facturacion = [
            "Raiden",
            "kenshi",
            "Melina",
            "Jhonny Cage"
        ];

    if (isset($_POST['submit'])){
        if(strlen($_POST['departamento'])>=1){
            $departamento=$_POST['departamento'];
        }
    }

    if($errors==0)
    {
        if($departamento=="atencionCliente"){
            $empleadoName=array_rand($atencionCliente,1);
            $empleadoAleatorioDato=$atencionCliente[$empleadoName];
        }elseif($departamento=="soporteTecnico"){
            $empleadoName=array_rand($soporteTecnico,1);
            $empleadoAleatorioDato=$soporteTecnico[$empleadoName];
        }elseif($departamento=="facturacion"){
            $empleadoName=array_rand($facturacion,1);
            $empleadoAleatorioDato=$facturacion[$empleadoName];
        }
    }   

    if ($errors == 0)
    {
        $query = 'INSERT INTO  contact (
            email,
            message,
            clienteName,
            departamento,
            empleadoName
        )   VALUES (
            "'.addslashes($_POST['email']).'",
            "'.addslashes($_POST['message']).'",
            "'.addslashes($_POST['clienteName']).'",
            "'.addslashes($_POST['departamento']).'",
            "'.addslashes($empleadoAleatorioDato).'" 
        )';
        mysqli_query($connect, $query);
    
        $idCaso = mysqli_insert_id($connect);

        $message = 'You have received a contact form submission:
    
            Email: '.$_POST['email'].'
            Message: '.$_POST['message'];
            $nombre2 = $_POST['clienteName'];
    
        mail('jcorredorg@hotmail.com',
            'Contact form submission',
            $message);
    
        header('Location: thankyou.php?idCaso=' . urlencode($idCaso) . '&clienteName=' . urlencode($nombre2) . '&departamento=' . urlencode($_POST['departamento']) . '&empleado=' . urlencode($empleadoAleatorioDato));
        die();
    }
    
    
    
}



    

    


 


?>

<!doctype html>
<html>
    <head>
        <title>PHP Contact Form</title>
    </head>
    <body>

        <h1>PHP Contact form</h1>

        <form method="post" action="">

            Email Address:
            <br>
            <input type="text" name="email" values = "<?php echo $email; ?>">
            <?php echo $email_error; ?>

            <br></br>

            Message:
            <br>
            <textarea name="message"><?php echo $message; ?></textarea>
            <?php echo $message_error; ?>

            <br></br>
            

            NombreCliente:
            <br>
            <input type="text" name="clienteName" values= "<?php echo $clienteName; ?>">
            <?php echo $clienteName_error; ?>
            <br></br>


            <br>
                <label for="departamento"> Departamento </label> 
                <br>
                <select id="departamento" name="departamento">
                    <option value="atencionCliente">Atención al Cliente</option>
                    <option value="soporteTecnico">Soporte Técnico</option>
                    <option value="facturacion">Facturación</option>
                </select>
            <br></br>


            <input name="submit" type="submit" value="Submit">
        
            
            


            <br></br>

        </form>

    </body>
</html>